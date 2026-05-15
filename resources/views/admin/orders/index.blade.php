@extends('layouts.app')

@section('title', 'Управление заказами')

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    <div style="margin-bottom: 40px;">
        <h1 style="font-size: 2rem; font-weight: bold; color: #1A1A1A;">Управление заказами</h1>
        <p style="color: #AAAAAA;">Просмотр и управление статусами заказов</p>
    </div>
    
    @if(session('success'))
        <div style="background: rgba(210, 111, 139, 0.1); border: 1px solid #D26F8B; border-radius: 12px; padding: 16px; margin-bottom: 24px;">
            <p style="color: #D26F8B;">✓ {{ session('success') }}</p>
        </div>
    @endif
    
    <div style="background: #FFFFFF; border-radius: 24px; overflow: hidden; border: 1px solid #F0E4E8; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #F0E4E8; text-align: left;">
                        <th style="padding: 16px; color: #888888; font-weight: 600;">№ заказа</th>
                        <th style="padding: 16px; color: #888888; font-weight: 600;">Покупатель</th>
                        <th style="padding: 16px; color: #888888; font-weight: 600;">Телефон</th>
                        <th style="padding: 16px; color: #888888; font-weight: 600;">Сумма</th>
                        <th style="padding: 16px; color: #888888; font-weight: 600;">Статус</th>
                        <th style="padding: 16px; color: #888888; font-weight: 600;">Дата</th>
                        <th style="padding: 16px; color: #888888; font-weight: 600;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr style="border-bottom: 1px solid #F0E4E8;">
                        <td style="padding: 16px; color: #1A1A1A; font-weight: 500;">{{ $order->order_number }}</td>
                        <td style="padding: 16px; color: #666666;">{{ $order->customer_name }}</td>
                        <td style="padding: 16px; color: #666666;">{{ $order->phone }}</td>
                        <td style="padding: 16px; color: #D26F8B; font-weight: 700;">{{ number_format($order->total_amount, 0, ',', ' ') }} ₽</td>
                        <td style="padding: 16px;">
                            @if($order->status == 'new')
                                <span style="background: rgba(210, 111, 139, 0.1); color: #D26F8B; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 500;">Новый</span>
                            @elseif($order->status == 'processing')
                                <span style="background: rgba(212, 175, 55, 0.1); color: #D4AF37; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 500;">В обработке</span>
                            @elseif($order->status == 'completed')
                                <span style="background: rgba(74, 124, 89, 0.1); color: #4A7C59; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 500;">Выполнен</span>
                            @else
                                <span style="background: rgba(229, 57, 53, 0.1); color: #E53935; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 500;">Отменен</span>
                            @endif
                        </td>
                        <td style="padding: 16px; color: #AAAAAA; font-size: 0.875rem;">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        <td style="padding: 16px;">
                            <a href="{{ route('admin.orders.show', $order) }}" style="color: #D26F8B; text-decoration: none; font-weight: 500; transition: color 0.3s;">Подробнее →</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div style="margin-top: 32px;">
        {{ $orders->links() }}
    </div>
</div>
@endsection