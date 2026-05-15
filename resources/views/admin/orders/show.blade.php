@extends('layouts.app')

@section('title', 'Заказ #' . $order->order_number)

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
        <div>
            <h1 style="font-size: 2rem; font-weight: bold; color: #1A1A1A;">Заказ #{{ $order->order_number }}</h1>
            <p style="color: #AAAAAA;">от {{ $order->created_at->format('d.m.Y H:i') }}</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" style="color: #D26F8B; text-decoration: none; font-weight: 500; transition: color 0.3s;">← Назад к заказам</a>
    </div>
    
    @if(session('success'))
        <div style="background: rgba(210, 111, 139, 0.1); border: 1px solid #D26F8B; border-radius: 12px; padding: 16px; margin-bottom: 24px;">
            <p style="color: #D26F8B;">✓ {{ session('success') }}</p>
        </div>
    @endif
    
    <div style="display: grid; grid-template-columns: 1fr; gap: 32px; grid-template-columns: 2fr 1fr;">
        <!-- Информация о заказе -->
        <div style="background: #FFFFFF; border-radius: 24px; padding: 32px; border: 1px solid #F0E4E8; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
            <h2 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 20px; color: #1A1A1A;">Состав заказа</h2>
            
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 1px solid #F0E4E8; text-align: left;">
                            <th style="padding: 12px 8px; color: #888888; font-weight: 600;">Товар</th>
                            <th style="padding: 12px 8px; color: #888888; font-weight: 600;">Кол-во</th>
                            <th style="padding: 12px 8px; color: #888888; font-weight: 600;">Цена</th>
                            <th style="padding: 12px 8px; color: #888888; font-weight: 600;">Сумма</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr style="border-bottom: 1px solid #F0E4E8;">
                            <td style="padding: 12px 8px; color: #1A1A1A; font-weight: 500;">{{ $item->flower_name }}</td>
                            <td style="padding: 12px 8px; color: #666666;">{{ $item->quantity }}</td>
                            <td style="padding: 12px 8px; color: #666666;">{{ number_format($item->price, 0, ',', ' ') }} ₽</td>
                            <td style="padding: 12px 8px; color: #D26F8B; font-weight: 700;">{{ number_format($item->total, 0, ',', ' ') }} ₽</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div style="border-top: 1px solid #F0E4E8; margin-top: 20px; padding-top: 20px;">
                <div style="display: flex; justify-content: space-between; font-size: 1.25rem; font-weight: bold;">
                    <span style="color: #1A1A1A;">Итого:</span>
                    <span style="color: #D26F8B;">{{ number_format($order->total_amount, 0, ',', ' ') }} ₽</span>
                </div>
            </div>
        </div>
        
        <!-- Информация о клиенте и статус -->
        <div>
            <div style="background: #FFFFFF; border-radius: 24px; padding: 32px; margin-bottom: 24px; border: 1px solid #F0E4E8; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
                <h2 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 20px; color: #1A1A1A;">Информация о клиенте</h2>
                <div style="margin-bottom: 16px;">
                    <p style="color: #AAAAAA; font-size: 0.75rem; margin-bottom: 4px;">Имя</p>
                    <p style="color: #1A1A1A; font-weight: 500;">{{ $order->customer_name }}</p>
                </div>
                <div style="margin-bottom: 16px;">
                    <p style="color: #AAAAAA; font-size: 0.75rem; margin-bottom: 4px;">Телефон</p>
                    <p style="color: #1A1A1A; font-weight: 500;">{{ $order->phone }}</p>
                </div>
                <div style="margin-bottom: 16px;">
                    <p style="color: #AAAAAA; font-size: 0.75rem; margin-bottom: 4px;">Адрес доставки</p>
                    <p style="color: #1A1A1A; font-weight: 500;">{{ $order->address }}</p>
                </div>
                @if($order->comment)
                <div>
                    <p style="color: #AAAAAA; font-size: 0.75rem; margin-bottom: 4px;">Комментарий</p>
                    <p style="color: #1A1A1A;">{{ $order->comment }}</p>
                </div>
                @endif
            </div>
            
            <div style="background: #FFFFFF; border-radius: 24px; padding: 32px; border: 1px solid #F0E4E8; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
                <h2 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 20px; color: #1A1A1A;">Статус заказа</h2>
                
                <form method="POST" action="{{ route('admin.orders.update-status', $order) }}">
                    @csrf
                    <select name="status" style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; margin-bottom: 16px; transition: all 0.3s;">
                        <option value="new" {{ $order->status == 'new' ? 'selected' : '' }}>Новый</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>В обработке</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Выполнен</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Отменен</option>
                    </select>
                    <button type="submit" style="width: 100%; background: #D26F8B; color: #FFFFFF; font-weight: 600; padding: 12px; border-radius: 40px; border: none; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(210, 111, 139, 0.25);">
                        Обновить статус
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection