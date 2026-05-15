<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Promocode;
use App\Models\PromocodeUsage;
use App\Services\YooKassaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    protected $yooKassaService;
    
    public function __construct(YooKassaService $yooKassaService)
    {
        $this->yooKassaService = $yooKassaService;
    }
    
    /**
     * Страница оформления заказа
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('catalog.index')->with('error', 'Корзина пуста');
        }
        
        $items = [];
        $subtotal = 0;
        
        foreach ($cart as $id => $details) {
            $itemTotal = $details['price'] * $details['quantity'];
            $items[] = [
                'id' => $id,
                'name' => $details['name'],
                'quantity' => $details['quantity'],
                'price' => $details['price'],
                'total' => $itemTotal,
            ];
            $subtotal += $itemTotal;
        }
        
        // Получаем примененный промокод
        $discount = session('discount', 0);
        $total = max(0, $subtotal - $discount);
        $appliedPromocode = session('applied_promocode');
        
        return view('checkout', compact('items', 'subtotal', 'total', 'discount', 'appliedPromocode'));
    }
    
    /**
     * Сохранение заказа и перенаправление на оплату
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'customer_name' => 'required|string|max:255|regex:/^[а-яА-ЯёЁa-zA-Z\s\-]+$/u',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:500|min:10',
                'comment' => 'nullable|string|max:1000',
            ]);
            
            $cart = session()->get('cart', []);
            
            if (empty($cart)) {
                return redirect()->route('catalog.index')->with('error', 'Корзина пуста');
            }
            
            DB::beginTransaction();
            
            // Очищаем телефон от лишних символов
            $cleanPhone = preg_replace('/[^0-9]/', '', $request->phone);
            if (strlen($cleanPhone) === 10) {
                $cleanPhone = '7' . $cleanPhone;
            }
            
            // Расчет суммы заказа
            $subtotal = 0;
            foreach ($cart as $id => $details) {
                $subtotal += $details['price'] * $details['quantity'];
            }
            
            // Получаем скидку из сессии
            $discount = session('discount', 0);
            $totalAmount = max(0, $subtotal - $discount);
            
            // Создаем заказ
            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'user_id' => auth()->id(),
                'customer_name' => $request->customer_name,
                'phone' => $cleanPhone,
                'address' => $request->address,
                'comment' => $request->comment,
                'subtotal' => $subtotal,
                'discount_amount' => $discount,
                'total_amount' => $totalAmount,
                'status' => 'new',
                'payment_status' => 'pending',
            ]);
            
            // Сохраняем информацию о промокоде
            $appliedPromocode = session('applied_promocode');
            if ($appliedPromocode && $discount > 0) {
                $order->update(['promocode_id' => $appliedPromocode['id']]);
                
                // Сохраняем использование промокода
                PromocodeUsage::create([
                    'promocode_id' => $appliedPromocode['id'],
                    'user_id' => auth()->id(),
                    'order_id' => $order->id,
                    'discount_amount' => $discount
                ]);
                
                // Увеличиваем счетчик использований промокода
                $promocode = Promocode::find($appliedPromocode['id']);
                if ($promocode) {
                    $promocode->increment('used_count');
                }
            }
            
            // Создаем позиции заказа
            foreach ($cart as $id => $details) {
                $itemTotal = $details['price'] * $details['quantity'];
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'flower_id' => $id,
                    'flower_name' => $details['name'],
                    'price' => $details['price'],
                    'quantity' => $details['quantity'],
                    'total' => $itemTotal,
                ]);
            }
            
            // Очищаем корзину и сессию промокода
            session()->forget('cart');
            session()->forget(['applied_promocode', 'discount']);
            
            DB::commit();
            
            // Создаем платеж через ЮKassa
            try {
                $paymentResult = $this->yooKassaService->createPayment($order);
                
                if ($paymentResult['success']) {
                    session(['current_payment_id' => $paymentResult['payment_id']]);
                    return redirect($paymentResult['payment_url']);
                } else {
                    return redirect()->route('order.success', $order)
                        ->with('warning', 'Заказ #' . $order->order_number . ' создан, но оплата временно недоступна.');
                }
            } catch (\Exception $e) {
                Log::error('YooKassa payment error: ' . $e->getMessage());
                return redirect()->route('order.success', $order)
                    ->with('warning', 'Заказ #' . $order->order_number . ' создан. Оплата будет доступна позже.');
            }
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order creation failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return back()->with('error', 'Ошибка: ' . $e->getMessage());
        }
    }
    
    /**
     * Страница успешного оформления заказа
     */
    public function success(Order $order)
    {
        // Проверяем, что заказ принадлежит текущему пользователю
        if (auth()->check() && $order->user_id !== auth()->id()) {
            abort(403);
        }
        
        return view('success', compact('order'));
    }
    
    /**
     * Callback после оплаты
     */
    public function paymentCallback(Order $order, Request $request)
    {
        if (!$order->payment_id) {
            return redirect()->route('order.success', $order)
                ->with('error', 'Информация о платеже не найдена');
        }
        
        $paymentInfo = $this->yooKassaService->getPaymentInfo($order->payment_id);
        
        if ($paymentInfo['success'] && $paymentInfo['paid']) {
            $order->update([
                'status' => 'paid',
                'payment_status' => 'succeeded'
            ]);
            
            return redirect()->route('order.success', $order)
                ->with('success', 'Заказ успешно оплачен!');
        }
        
        return redirect()->route('order.success', $order)
            ->with('warning', 'Заказ создан, но оплата не подтверждена. Наш менеджер свяжется с вами.');
    }
}