@extends('layouts.app')

@section('title', 'Заказ оформлен')

@section('content')
<div class="container">
    <div class="success-wrapper">
        
        @if(session('success'))
        <div class="alert-success">
            ✓ {{ session('success') }}
        </div>
        @endif
        
        @if(session('warning'))
        <div class="alert-warning">
            ⚠ {{ session('warning') }}
        </div>
        @endif
        
        @if(session('error'))
        <div class="alert-error">
            ✗ {{ session('error') }}
        </div>
        @endif
        
        <div class="icon-circle">
            <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        
        <h1 class="success-title">Заказ успешно оформлен!</h1>
        
        <p class="order-label">Номер вашего заказа:</p>
        <p class="order-number">{{ $order->order_number }}</p>
        
        <!-- Статус оплаты -->
        @if($order->status === 'paid')
        <div class="payment-status">
            <p class="status-paid">✓ Заказ оплачен</p>
        </div>
        @endif
        
        <div class="order-details">
            <h3 class="details-title">Детали заказа:</h3>
            <div class="details-list">
                <div class="detail-row">
                    <span class="detail-label">Получатель:</span>
                    <span class="detail-value">{{ $order->customer_name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Телефон:</span>
                    <span class="detail-value">+{{ $order->phone }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Адрес:</span>
                    <span class="detail-value address">{{ $order->address }}</span>
                </div>
                <div class="detail-divider"></div>
                <div class="detail-row total">
                    <span class="detail-label">Сумма:</span>
                    <span class="detail-value price">{{ number_format($order->total_amount, 0, ',', ' ') }} ₽</span>
                </div>
                @if($order->comment)
                <div class="detail-row">
                    <span class="detail-label">Комментарий:</span>
                    <span class="detail-value comment">{{ $order->comment }}</span>
                </div>
                @endif
            </div>
        </div>
        
        <div class="action-buttons">
            <a href="{{ route('catalog.index') }}" class="btn-primary">
                Продолжить покупки
            </a>
            @auth
            <a href="{{ route('profile.index') }}" class="btn-secondary">
                Мои заказы
            </a>
            @endauth
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
    
    .success-wrapper {
        max-width: 550px;
        margin: 0 auto;
        text-align: center;
        padding: 60px 0 80px;
    }
    
    /* Алерты */
    .alert-success {
        background: #d4edda;
        border: 1px solid #c3e6cb;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 24px;
        color: #155724;
        font-size: 0.9rem;
    }
    
    .alert-warning {
        background: #fff3cd;
        border: 1px solid #ffeeba;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 24px;
        color: #856404;
        font-size: 0.9rem;
    }
    
    .alert-error {
        background: #f8d7da;
        border: 1px solid #f5c6cb;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 24px;
        color: #721c24;
        font-size: 0.9rem;
    }
    
    /* Иконка */
    .icon-circle {
        width: 96px;
        height: 96px;
        background: rgba(210, 111, 139, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        color: #D26F8B;
    }
    
    /* Заголовок */
    .success-title {
        font-size: clamp(1.5rem, 5vw, 2rem);
        font-weight: bold;
        margin-bottom: 24px;
        color: #1A1A1A;
    }
    
    .order-label {
        color: #888888;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }
    
    .order-number {
        color: #D26F8B;
        font-weight: bold;
        font-size: clamp(1.2rem, 4vw, 1.5rem);
        margin-bottom: 24px;
        word-break: break-all;
    }
    
    /* Статус оплаты */
    .payment-status {
        background: #F8F9FA;
        border-radius: 16px;
        padding: 16px;
        margin-bottom: 24px;
    }
    
    .status-paid {
        color: #4A7C59;
        font-weight: 600;
        margin: 0;
    }
    
    /* Детали заказа */
    .order-details {
        background: #FFFFFF;
        border-radius: 24px;
        padding: clamp(20px, 5vw, 24px);
        margin-bottom: 32px;
        text-align: left;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #F0E4E8;
    }
    
    .details-title {
        font-weight: 600;
        margin-bottom: 16px;
        color: #1A1A1A;
        font-size: 1.1rem;
    }
    
    .details-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
        font-size: 0.875rem;
    }
    
    .detail-row {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .detail-label {
        color: #888888;
        flex-shrink: 0;
    }
    
    .detail-value {
        color: #1A1A1A;
        text-align: right;
        word-break: break-word;
        flex: 1;
    }
    
    .detail-value.address {
        max-width: 60%;
    }
    
    .detail-value.comment {
        max-width: 60%;
        color: #666666;
    }
    
    .detail-divider {
        border-top: 1px solid #F0E4E8;
        margin: 4px 0;
    }
    
    .detail-row.total {
        padding-top: 8px;
    }
    
    .detail-value.price {
        color: #D26F8B;
        font-weight: bold;
        font-size: 1rem;
    }
    
    /* Кнопки действий */
    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    
    .btn-primary {
        display: inline-block;
        background: #D26F8B;
        color: #FFFFFF;
        font-weight: 600;
        padding: 12px 32px;
        border-radius: 40px;
        text-decoration: none;
        transition: all 0.3s;
        text-align: center;
    }
    
    .btn-primary:hover {
        background: #E89BB3;
        transform: translateY(-2px);
    }
    
    .btn-secondary {
        display: inline-block;
        color: #D26F8B;
        text-decoration: none;
        transition: all 0.3s;
        text-align: center;
        padding: 12px 32px;
        border-radius: 40px;
        background: transparent;
        border: 1px solid #D26F8B;
    }
    
    .btn-secondary:hover {
        color: #E89BB3;
        border-color: #E89BB3;
    }
    
    /* Адаптивность */
    @media (max-width: 1024px) {
        .container {
            padding: 0 30px;
        }
        
        .success-wrapper {
            padding: 50px 0 70px;
        }
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 0 20px;
        }
        
        .success-wrapper {
            padding: 40px 0 60px;
        }
        
        .detail-row {
            flex-direction: column;
            gap: 4px;
        }
        
        .detail-label {
            text-align: left;
        }
        
        .detail-value {
            text-align: left;
        }
        
        .detail-value.address,
        .detail-value.comment {
            max-width: 100%;
        }
        
        .order-details {
            padding: 16px;
        }
    }
    
    @media (max-width: 480px) {
        .container {
            padding: 0 15px;
        }
        
        .success-wrapper {
            padding: 30px 0 50px;
        }
        
        .icon-circle {
            width: 70px;
            height: 70px;
        }
        
        .icon-circle svg {
            width: 35px;
            height: 35px;
        }
        
        .btn-primary, .btn-secondary {
            padding: 10px 20px;
            font-size: 0.9rem;
        }
        
        .order-number {
            font-size: 1rem;
        }
    }
</style>
@endsection