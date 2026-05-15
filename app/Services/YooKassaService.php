<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Log;



// Ручной автозагрузчик для ЮKassa
spl_autoload_register(function ($class) {
    // Карта соответствия классов и файлов
    $map = [
        'YooKassa\\Client' => 'vendor/yoomoney/yookassa-sdk-php/lib/YooKassa/Client.php',
        'YooKassa\\Model\\Payment\\Payment' => 'vendor/yoomoney/yookassa-sdk-php/lib/YooKassa/Model/Payment/Payment.php',
        'YooKassa\\Common\\AbstractObject' => 'vendor/yoomoney/yookassa-sdk-php/lib/YooKassa/Common/AbstractObject.php',
        'YooKassa\\Common\\Exceptions\\ApiException' => 'vendor/yoomoney/yookassa-sdk-php/lib/YooKassa/Common/Exceptions/ApiException.php',
        'YooKassa\\Validator\\Validator' => 'vendor/yoomoney/yookassa-sdk-validator/lib/YooKassa/Validator/Validator.php',
    ];
    
    if (isset($map[$class])) {
        $file = base_path($map[$class]);
        if (file_exists($file)) {
            require_once $file;
        }
    }
});
// Ручная загрузка всех необходимых файлов SDK
$sdkBasePath = base_path('vendor/yoomoney/yookassa-sdk-php/lib/');
$validatorBasePath = base_path('vendor/yoomoney/yookassa-sdk-validator/lib/');

// Загружаем все файлы из папки YooKassa
if (is_dir($sdkBasePath . 'YooKassa/')) {
    foreach (glob($sdkBasePath . 'YooKassa/*.php') as $file) {
        require_once $file;
    }
}

// Загружаем все файлы из подпапок
$subdirs = ['Common', 'Model', 'Request', 'Client'];
foreach ($subdirs as $subdir) {
    $path = $sdkBasePath . 'YooKassa/' . $subdir . '/';
    if (is_dir($path)) {
        foreach (glob($path . '*.php') as $file) {
            require_once $file;
        }
    }
}

// Загружаем валидатор
if (is_dir($validatorBasePath . 'YooKassa/Validator/')) {
    foreach (glob($validatorBasePath . 'YooKassa/Validator/*.php') as $file) {
        require_once $file;
    }
}

// Проверяем, загрузился ли класс
if (!class_exists('YooKassa\Client')) {
    throw new \Exception('ЮKassa SDK не загружен. Путь: ' . $sdkBasePath);
}

use YooKassa\Client;

class YooKassaService
{
    protected $client;
    
    public function __construct()
    {
        $this->client = new Client();
        $this->client->setAuth(
            config('services.yookassa.shop_id'),
            config('services.yookassa.secret_key')
        );
    }
    
    public function createPayment(Order $order)
    {
        try {
            $payment = $this->client->createPayment(
                [
                    'amount' => [
                        'value' => (float)$order->total_amount,
                        'currency' => 'RUB',
                    ],
                    'confirmation' => [
                        'type' => 'redirect',
                        'return_url' => route('payment.callback', $order),
                    ],
                    'capture' => true,
                    'description' => 'Оплата заказа №' . ($order->order_number ?? $order->id),
                    'metadata' => [
                        'order_id' => $order->id,
                        'order_number' => $order->order_number ?? $order->id,
                    ],
                ],
                uniqid('', true)
            );
            
            $order->update([
                'payment_id' => $payment->getId(),
                'payment_status' => $payment->getStatus()
            ]);
            
            return [
                'success' => true,
                'payment_url' => $payment->getConfirmation()->getConfirmationUrl(),
                'payment_id' => $payment->getId(),
            ];
            
        } catch (\Exception $e) {
            Log::error('YooKassa payment creation failed: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
    
    public function getPaymentInfo($paymentId)
    {
        try {
            $payment = $this->client->getPaymentInfo($paymentId);
            return [
                'success' => true,
                'status' => $payment->getStatus(),
                'paid' => $payment->getPaid(),
                'amount' => $payment->getAmount()->getValue(),
            ];
        } catch (\Exception $e) {
            Log::error('Failed to get payment info: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
}