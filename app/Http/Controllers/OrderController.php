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
    
    $discount = session('discount', 0);
    $total = max(0, $subtotal - $discount);
    $appliedPromocode = session('applied_promocode');
    
    // Все возможные интервалы
    $allTimeSlots = [
        '08:00-09:00' => '08:00 - 09:00',
        '09:00-10:00' => '09:00 - 10:00',
        '10:00-11:00' => '10:00 - 11:00',
        '11:00-12:00' => '11:00 - 12:00',
        '12:00-13:00' => '12:00 - 13:00',
        '13:00-14:00' => '13:00 - 14:00',
        '14:00-15:00' => '14:00 - 15:00',
        '15:00-16:00' => '15:00 - 16:00',
        '16:00-17:00' => '16:00 - 17:00',
        '17:00-18:00' => '17:00 - 18:00',
        '18:00-19:00' => '18:00 - 19:00',
        '19:00-20:00' => '19:00 - 20:00',
        '20:00-21:00' => '20:00 - 21:00',
        '21:00-22:00' => '21:00 - 22:00',
    ];
    
    // Получаем занятые интервалы на выбранную дату
    $selectedDate = old('delivery_date', date('Y-m-d'));
    
    // ИСПРАВЛЕНО: используем поле delivery_time вместо delivery_time_from и delivery_time_to
    $bookedSlots = Order::where('delivery_date', $selectedDate)
        ->where('status', '!=', 'cancelled')
        ->whereNotNull('delivery_time')
        ->get()
        ->map(function($order) {
            return $order->delivery_time;
        })
        ->toArray();
    
    return view('checkout', compact('items', 'subtotal', 'total', 'discount', 'appliedPromocode', 'allTimeSlots', 'bookedSlots', 'selectedDate'));
}
    
public function store(Request $request)
{
    try {
        $request->validate([
            'customer_name' => 'required|string|max:255|regex:/^[а-яА-ЯёЁa-zA-Z\s\-]+$/u',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'house' => 'required|string|max:50',
            'apartment' => 'required|string|max:20',
            'entrance' => 'required|string|max:10',
            'floor' => 'required|string|max:10',
            'door_code' => 'nullable|string|max:20',
            'address_comment' => 'nullable|string|max:500',
            'delivery_date' => 'required|date|after_or_equal:today',
            'delivery_time' => 'required|string',
            'comment' => 'nullable|string|max:1000',
        ], [
            'customer_name.required' => 'Пожалуйста, укажите ваше имя',
            'customer_name.regex' => 'Имя может содержать только буквы, пробелы и дефисы',
            'phone.required' => 'Пожалуйста, укажите номер телефона',
            'city.required' => 'Пожалуйста, укажите город',
            'street.required' => 'Пожалуйста, укажите улицу',
            'house.required' => 'Пожалуйста, укажите номер дома',
            'apartment.required' => 'Пожалуйста, укажите квартиру/офис',
            'entrance.required' => 'Пожалуйста, укажите подъезд',
            'floor.required' => 'Пожалуйста, укажите этаж',
            'delivery_date.required' => 'Пожалуйста, выберите дату доставки',
            'delivery_date.after_or_equal' => 'Дата доставки не может быть раньше сегодняшнего дня',
            'delivery_time.required' => 'Пожалуйста, выберите время доставки',
        ]);
        
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('catalog.index')->with('error', 'Корзина пуста');
        }
        
        DB::beginTransaction();
        
        $cleanPhone = preg_replace('/[^0-9]/', '', $request->phone);
        if (strlen($cleanPhone) === 10) {
            $cleanPhone = '7' . $cleanPhone;
        }
        
        $fullAddress = $request->city . ', ' . $request->street . ', д. ' . $request->house;
        if ($request->apartment) {
            $fullAddress .= ', кв. ' . $request->apartment;
        }
        if ($request->entrance) {
            $fullAddress .= ', подъезд ' . $request->entrance;
        }
        if ($request->floor) {
            $fullAddress .= ', этаж ' . $request->floor;
        }
        if ($request->address_comment) {
            $fullAddress .= ' (' . $request->address_comment . ')';
        }
        
        $subtotal = 0;
        foreach ($cart as $id => $details) {
            $subtotal += $details['price'] * $details['quantity'];
        }
        
        $discount = session('discount', 0);
        $totalAmount = max(0, $subtotal - $discount);
        
        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'user_id' => auth()->id(),
            'customer_name' => $request->customer_name,
            'phone' => $cleanPhone,
            'address' => $fullAddress,
            'city' => $request->city,
            'street' => $request->street,
            'house' => $request->house,
            'entrance' => $request->entrance,
            'door_code' => $request->door_code,
            'floor' => $request->floor,
            'apartment' => $request->apartment,
            'address_comment' => $request->address_comment,
            'delivery_date' => $request->delivery_date,
            'delivery_time' => $request->delivery_time,  // ← СОХРАНЯЕМ ЦЕЛИКОМ
            'comment' => $request->comment,
            'subtotal' => $subtotal,
            'discount_amount' => $discount,
            'total_amount' => $totalAmount,
            'status' => 'new',
            'payment_status' => 'pending',
        ]);
        
        
            Log::info('Order created', [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'status' => $order->status
            ]);
            
            $appliedPromocode = session('applied_promocode');
            if ($appliedPromocode && $discount > 0) {
                $order->update(['promocode_id' => $appliedPromocode['id']]);
                
                PromocodeUsage::create([
                    'promocode_id' => $appliedPromocode['id'],
                    'user_id' => auth()->id(),
                    'order_id' => $order->id,
                    'discount_amount' => $discount
                ]);
                
                $promocode = Promocode::find($appliedPromocode['id']);
                if ($promocode) {
                    $promocode->increment('used_count');
                }
            }
            
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
            
            session()->forget('cart');
            session()->forget(['applied_promocode', 'discount']);
            
            DB::commit();
            
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
            
            return back()->with('error', 'Ошибка при создании заказа: ' . $e->getMessage())->withInput();
        }
    }
    
    public function success(Order $order)
    {
        if (auth()->check() && $order->user_id !== auth()->id()) {
            abort(403);
        }
        
        return view('success', compact('order'));
    }
    
    public function paymentCallback(Order $order, Request $request)
    {
        if (!$order->payment_id) {
            return redirect()->route('order.success', $order)
                ->with('error', 'Информация о платеже не найдена');
        }
        
        $paymentInfo = $this->yooKassaService->getPaymentInfo($order->payment_id);
        
        if ($paymentInfo['success'] && $paymentInfo['paid']) {
            $order->update([
                'status' => 'new',
                'payment_status' => 'succeeded'
            ]);
            
            return redirect()->route('order.success', $order)
                ->with('success', 'Заказ успешно оплачен!');
        }
        
        return redirect()->route('order.success', $order)
            ->with('warning', 'Заказ создан, но оплата не подтверждена. Наш менеджер свяжется с вами.');
    }
}