<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\YooKassaService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $yooKassaService;
    
    public function __construct(YooKassaService $yooKassaService)
    {
        $this->yooKassaService = $yooKassaService;
    }
    
    /**
     * Инициализация платежа
     */
    public function pay(Order $order)
    {
        // Проверяем, не оплачен ли уже заказ
        if ($order->status === 'paid') {
            return redirect()->route('profile.orders')->with('error', 'Заказ уже оплачен');
        }
        
        $result = $this->yooKassaService->createPayment($order);
        
        if ($result['success']) {
            // Перенаправляем на страницу оплаты
            return redirect($result['payment_url']);
        } else {
            return back()->with('error', 'Ошибка создания платежа: ' . $result['error']);
        }
    }
    
    /**
     * Callback после оплаты
     */
    public function callback(Order $order, Request $request)
    {
        // Проверяем статус платежа
        $paymentId = $order->payment_id;
        
        if (!$paymentId) {
            return redirect()->route('profile.orders')->with('error', 'Информация о платеже не найдена');
        }
        
        $paymentInfo = $this->yooKassaService->getPaymentInfo($paymentId);
        
        if ($paymentInfo['success'] && $paymentInfo['paid']) {
            // Обновляем статус заказа
            $order->update([
                'status' => 'paid',
                'payment_status' => 'succeeded'
            ]);
            
            return redirect()->route('profile.orders')->with('success', 'Заказ успешно оплачен!');
        }
        
        return redirect()->route('profile.orders')->with('error', 'Платеж не был завершен');
    }
    
    /**
     * Webhook для уведомлений от ЮKassa
     */
    public function webhook(Request $request)
    {
        $source = file_get_contents('php://input');
        $data = json_decode($source, true);
        
        Log::info('YooKassa webhook received', $data);
        
        // Обрабатываем событие успешной оплаты
        if (isset($data['event']) && $data['event'] === 'payment.succeeded') {
            $paymentId = $data['object']['id'];
            $metadata = $data['object']['metadata'] ?? [];
            
            // Находим заказ по metadata или payment_id
            $order = null;
            
            if (isset($metadata['order_id'])) {
                $order = Order::find($metadata['order_id']);
            } else {
                $order = Order::where('payment_id', $paymentId)->first();
            }
            
            if ($order && $order->status !== 'paid') {
                $order->update([
                    'status' => 'paid',
                    'payment_status' => 'succeeded'
                ]);
                Log::info('Order #' . $order->id . ' marked as paid via webhook');
            }
        }
        
        return response()->json(['success' => true]);
    }
}