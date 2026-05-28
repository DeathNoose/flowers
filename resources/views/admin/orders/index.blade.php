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
    
    {{-- Фильтрация --}}
    <div style="background: #FFFFFF; border-radius: 20px; padding: 24px; margin-bottom: 32px; border: 1px solid #F0E4E8; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
        <form method="GET" action="{{ route('admin.orders.index') }}" style="display: flex; flex-wrap: wrap; gap: 16px; align-items: flex-end;">
            {{-- Поиск по номеру заказа или покупателю --}}
            <div style="flex: 2; min-width: 200px;">
                <label for="search" style="display: block; font-size: 0.8rem; color: #888888; margin-bottom: 6px;">Поиск</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                       placeholder="№ заказа или имя покупателя"
                       style="width: 100%; padding: 10px 14px; border: 1px solid #F0E4E8; border-radius: 12px; background: #FAF8F9; outline: none; transition: all 0.3s;">
            </div>
            
            {{-- Фильтр по статусу --}}
            <div style="flex: 1; min-width: 160px;">
                <label for="status" style="display: block; font-size: 0.8rem; color: #888888; margin-bottom: 6px;">Статус</label>
                <select name="status" id="status" style="width: 100%; padding: 10px 14px; border: 1px solid #F0E4E8; border-radius: 12px; background: #FAF8F9; outline: none; cursor: pointer;">
                    <option value="">Все статусы</option>
                    <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>🆕 Новый</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>🔄 В обработке</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>✅ Выполнен</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>❌ Отменен</option>
                </select>
            </div>
            
            {{-- Фильтр по дате --}}
            <div style="flex: 1; min-width: 160px;">
                <label for="date_from" style="display: block; font-size: 0.8rem; color: #888888; margin-bottom: 6px;">Дата от</label>
                <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                       style="width: 100%; padding: 10px 14px; border: 1px solid #F0E4E8; border-radius: 12px; background: #FAF8F9; outline: none;">
            </div>
            
            <div style="flex: 1; min-width: 160px;">
                <label for="date_to" style="display: block; font-size: 0.8rem; color: #888888; margin-bottom: 6px;">Дата до</label>
                <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                       style="width: 100%; padding: 10px 14px; border: 1px solid #F0E4E8; border-radius: 12px; background: #FAF8F9; outline: none;">
            </div>
            
            {{-- Кнопки --}}
            <div style="display: flex; gap: 12px;">
                <button type="submit" style="background: #D26F8B; color: #FFFFFF; border: none; padding: 10px 24px; border-radius: 40px; font-weight: 600; cursor: pointer; transition: all 0.3s;">
                    🔍 Применить
                </button>
                <a href="{{ route('admin.orders.index') }}" style="background: #FAF8F9; color: #888888; border: 1px solid #F0E4E8; padding: 10px 20px; border-radius: 40px; text-decoration: none; font-weight: 500; transition: all 0.3s;">
                    🗑️ Сбросить
                </a>
            </div>
        </form>
    </div>
    
    {{-- Результаты фильтрации --}}
    @if(request()->anyFilled(['search', 'status', 'date_from', 'date_to']))
        <div style="margin-bottom: 20px; padding: 12px 20px; background: rgba(210, 111, 139, 0.05); border-radius: 12px;">
            <span style="color: #D26F8B;">🔍 Найдено заказов: {{ $orders->total() }}</span>
            <a href="{{ route('admin.orders.index') }}" style="margin-left: 16px; color: #888888; text-decoration: none; font-size: 0.85rem;">✖ Очистить фильтры</a>
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
                    @forelse($orders as $order)
                    <tr style="border-bottom: 1px solid #F0E4E8;">
                        <td style="padding: 16px; color: #1A1A1A; font-weight: 500;">{{ $order->order_number }}</td>
                        <td style="padding: 16px; color: #666666;">{{ $order->customer_name }} @if($order->user_id) <span style="font-size: 0.7rem; color: #D26F8B;">(зарег.)</span> @endif</td>
                        <td style="padding: 16px; color: #666666;">{{ $order->phone }}</td>
                        <td style="padding: 16px; color: #D26F8B; font-weight: 700;">{{ number_format($order->total_amount, 0, ',', ' ') }} ₽</td>
                        <td style="padding: 16px;">
                            @if($order->status == 'new')
                                <span style="background: rgba(210, 111, 139, 0.1); color: #D26F8B; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 500;">🆕 Новый</span>
                            @elseif($order->status == 'processing')
                                <span style="background: rgba(212, 175, 55, 0.1); color: #D4AF37; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 500;">🔄 В обработке</span>
                            @elseif($order->status == 'completed')
                                <span style="background: rgba(74, 124, 89, 0.1); color: #4A7C59; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 500;">✅ Выполнен</span>
                            @else
                                <span style="background: rgba(229, 57, 53, 0.1); color: #E53935; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 500;">❌ Отменен</span>
                            @endif
                        </td>
                        <td style="padding: 16px; color: #AAAAAA; font-size: 0.875rem;">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        <td style="padding: 16px;">
                            <a href="{{ route('admin.orders.show', $order) }}" style="color: #D26F8B; text-decoration: none; font-weight: 500; transition: color 0.3s;">Подробнее →</a>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="padding: 60px; text-align: center; color: #AAAAAA;">
                                📭 Заказы не найдены
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div style="margin-top: 32px;">
        {{ $orders->appends(request()->query())->links() }}
    </div>
</div>

<style>
    .container {
        max-width: 1400px;
        width: 100%;
        margin: 0 auto;
        padding: 0 40px;
    }
    
    @media (max-width: 1024px) {
        .container {
            padding: 0 20px;
        }
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 0 16px;
        }
        h1 {
            font-size: 1.5rem !important;
        }
        th, td {
            padding: 12px !important;
            font-size: 0.8rem;
        }
    }
    
    input:focus, select:focus {
        border-color: #D26F8B !important;
        box-shadow: 0 0 0 3px rgba(210, 111, 139, 0.1);
    }
    
    button:hover, .filter-btn:hover {
        background: #E89BB3 !important;
        transform: translateY(-1px);
    }
    
    .reset-btn:hover {
        background: #F0E4E8 !important;
    }
    
    .pagination {
        display: flex;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    .pagination a, .pagination span {
        padding: 8px 14px;
        background: #FFFFFF;
        border: 1px solid #F0E4E8;
        border-radius: 8px;
        color: #1A1A1A;
        text-decoration: none;
        transition: all 0.3s;
        font-size: 0.875rem;
    }
    
    .pagination a:hover {
        background: #D26F8B;
        color: #FFFFFF;
        border-color: #D26F8B;
    }
    
    .pagination .active span {
        background: #D26F8B;
        color: #FFFFFF;
        border-color: #D26F8B;
    }
</style>
@endsection