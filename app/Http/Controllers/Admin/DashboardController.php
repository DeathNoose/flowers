<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Flower;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ========== ОСНОВНАЯ СТАТИСТИКА ==========
        
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalProducts = Flower::count();
        $pendingOrders = Order::where('status', 'new')->count();
        $totalRevenue = Order::whereIn('status', ['completed', 'paid'])->sum('total_amount');
        $recentOrders = Order::with('user')->orderBy('created_at', 'desc')->take(5)->get();
        
        // ========== ДАННЫЕ ДЛЯ ГРАФИКОВ (7 дней) ==========
        
        $orderDates = [];
        $orderCounts = [];
        $revenueAmounts = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dateString = $date->format('Y-m-d');
            $formattedDate = $date->format('d.m');
            
            $count = Order::whereDate('created_at', $dateString)->count();
            $revenue = Order::whereDate('created_at', $dateString)
                ->whereIn('status', ['completed', 'paid'])
                ->sum('total_amount');
            
            $orderDates[] = $formattedDate;
            $orderCounts[] = $count;
            $revenueAmounts[] = $revenue;
        }
        
        // ========== РАСШИРЕННАЯ АНАЛИТИКА ПРОДАЖ ==========
        
        // 1. Топ-10 самых продаваемых товаров (по количеству)
        $popularProducts = OrderItem::select('flower_id', 'flower_name')
            ->selectRaw('SUM(quantity) as total_quantity')
            ->selectRaw('SUM(total) as total_revenue')
            ->groupBy('flower_id', 'flower_name')
            ->orderByDesc('total_quantity')
            ->limit(10)
            ->get();
        
        // 2. Топ-10 товаров по выручке
        $topByRevenue = OrderItem::select('flower_id', 'flower_name')
            ->selectRaw('SUM(quantity) as total_quantity')
            ->selectRaw('SUM(total) as total_revenue')
            ->groupBy('flower_id', 'flower_name')
            ->orderByDesc('total_revenue')
            ->limit(10)
            ->get();
        
        // 3. Продажи по категориям
        $salesByCategory = DB::table('order_items')
            ->join('flowers', 'order_items.flower_id', '=', 'flowers.id')
            ->join('categories', 'flowers.category_id', '=', 'categories.id')
            ->select('categories.name', 
                DB::raw('SUM(order_items.quantity) as total_quantity'), 
                DB::raw('SUM(order_items.total) as total_revenue'))
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('total_revenue')
            ->get();
        
        // 4. Сезонность продаж по месяцам (текущий год)
        $monthlySales = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as orders_count'),
                DB::raw('SUM(total_amount) as revenue')
            )
            ->whereIn('status', ['completed', 'paid'])
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->get();
        
        // 5. Топ-10 товаров по среднему чеку
        $averageCheck = OrderItem::select('flower_id', 'flower_name')
            ->selectRaw('AVG(total) as avg_check')
            ->selectRaw('COUNT(*) as times_purchased')
            ->groupBy('flower_id', 'flower_name')
            ->having('times_purchased', '>=', 3)  // минимум 3 покупки для достоверности
            ->orderByDesc('avg_check')
            ->limit(10)
            ->get();
        
        // 6. Общая статистика продаж
        $totalSoldItems = OrderItem::sum('quantity');
        $averageOrderValue = Order::whereIn('status', ['completed', 'paid'])->avg('total_amount') ?? 0;
        
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalOrders',
            'totalProducts',
            'pendingOrders',
            'totalRevenue',
            'recentOrders',
            'orderDates',
            'orderCounts',
            'revenueAmounts',
            'popularProducts',
            'topByRevenue',
            'salesByCategory',
            'monthlySales',
            'averageCheck',
            'totalSoldItems',
            'averageOrderValue'
        ));
    }
}