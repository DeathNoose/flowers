@extends('layouts.app')

@section('title', 'Заказ оформлен')

@section('content')
<div class="container" style="padding: 80px 0;">
    <div style="max-width: 500px; margin: 0 auto; text-align: center;">
        
        @if(session('success'))
        <div style="background: #d4edda; border: 1px solid #c3e6cb; border-radius: 12px; padding: 16px; margin-bottom: 24px; color: #155724;">
            ✓ {{ session('success') }}
        </div>
        @endif
        
        @if(session('warning'))
        <div style="background: #fff3cd; border: 1px solid #ffeeba; border-radius: 12px; padding: 16px; margin-bottom: 24px; color: #856404;">
            ⚠ {{ session('warning') }}
        </div>
        @endif
        
        @if(session('error'))
        <div style="background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 12px; padding: 16px; margin-bottom: 24px; color: #721c24;">
            ✗ {{ session('error') }}
        </div>
        @endif
        
        <div style="width: 96px; height: 96px; background: rgba(210, 111, 139, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
            <svg style="width: 48px; height: 48px; color: #D26F8B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        
        <h1 style="font-size: 2rem; font-weight: bold; margin-bottom: 16px; color: #1A1A1A;">Заказ успешно оформлен!</h1>
        
        <p style="color: #888888; margin-bottom: 8px;">
            Номер вашего заказа:
        </p>
        <p style="color: #D26F8B; font-weight: bold; font-size: 1.5rem; margin-bottom: 16px;">
            {{ $order->order_number }}
        </p>
        
        <!-- Статус оплаты -->
        <div style="background: #F8F9FA; border-radius: 16px; padding: 16px; margin-bottom: 24px;">
            @if($order->status === 'paid')
                <p style="color: #4A7C59; font-weight: 600;">✓ Заказ оплачен</p>
            @else
                <p style="color: #D26F8B; margin-bottom: 12px;">Статус оплаты: ожидает оплаты</p>
                
                @if($order->payment_id)
                <a href="{{ route('payment.pay', $order) }}" 
                   style="display: inline-block; background: #D26F8B; color: white; padding: 10px 24px; border-radius: 40px; text-decoration: none; font-size: 0.9rem;">
                    Перейти к оплате
                </a>
                @else
                <p style="color: #888888; font-size: 0.875rem;">Ссылка на оплату будет отправлена на ваш телефон</p>
                @endif
            @endif
        </div>
        
        <p style="color: #888888; margin-bottom: 32px; font-size: 0.9rem;">
            Наш менеджер свяжется с вами в ближайшее время для подтверждения заказа.
        </p>
        
        <div style="background: #FFFFFF; border-radius: 24px; padding: 24px; margin-bottom: 32px; text-align: left; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
            <h3 style="font-weight: 600; margin-bottom: 16px; color: #1A1A1A;">Детали заказа:</h3>
            <div style="display: flex; flex-direction: column; gap: 8px; font-size: 0.875rem;">
                <div style="display: flex; justify-content: space-between;">
                    <span style="color: #888888;">Получатель:</span>
                    <span style="color: #1A1A1A;">{{ $order->customer_name }}</span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="color: #888888;">Телефон:</span>
                    <span style="color: #1A1A1A;">+{{ $order->phone }}</span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="color: #888888;">Адрес:</span>
                    <span style="color: #1A1A1A; text-align: right; max-width: 60%;">{{ $order->address }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; padding-top: 8px; border-top: 1px solid #F0E4E8; margin-top: 4px;">
                    <span style="color: #1A1A1A; font-weight: 600;">Сумма:</span>
                    <span style="color: #D26F8B; font-weight: bold;">{{ number_format($order->total_amount, 0, ',', ' ') }} ₽</span>
                </div>
                @if($order->comment)
                <div style="display: flex; justify-content: space-between; margin-top: 4px;">
                    <span style="color: #888888;">Комментарий:</span>
                    <span style="color: #1A1A1A; text-align: right; max-width: 60%;">{{ $order->comment }}</span>
                </div>
                @endif
            </div>
        </div>
        
        <div style="display: flex; flex-direction: column; gap: 12px;">
            <a href="{{ route('catalog.index') }}" style="display: inline-block; background: #D26F8B; color: #FFFFFF; font-weight: 600; padding: 12px 32px; border-radius: 40px; text-decoration: none; transition: all 0.3s;">
                Продолжить покупки
            </a>
            <a href="{{ route('profile.orders') }}" style="display: inline-block; color: #D26F8B; text-decoration: none; transition: color 0.3s;">
                Мои заказы
            </a>
        </div>
    </div>
</div>

<style>
    .container {
        max-width: 1400px;
        width: 100%;
        margin: 0 auto;
        padding: 0 40px;
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 0 20px;
        }
        h1 {
            font-size: 1.5rem !important;
        }
    }
    
    a[href="{{ route('catalog.index') }}"]:hover {
        background: #E89BB3 !important;
        transform: translateY(-2px);
    }
    
    a[href="{{ route('profile.orders') }}"]:hover {
        color: #E89BB3 !important;
    }
</style>
@endsection