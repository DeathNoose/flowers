<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();
        
        // Поиск по номеру заказа или имени покупателя
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%");
            });
        }
        
        // Фильтр по статусу
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Фильтр по дате от
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        // Фильтр по дате до
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        $orders = $query->orderBy('created_at', 'desc')->paginate(20);
        
        return view('admin.orders.index', compact('orders'));
    }
    
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }
    
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:new,processing,completed,cancelled',
        ]);
        
        $order->status = $request->status;
        $order->save();
        
        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Статус заказа обновлен');
    }
}