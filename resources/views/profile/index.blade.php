@extends('layouts.app')

@section('title', 'Личный кабинет')

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    <h1 style="font-size: 2rem; font-weight: bold; margin-bottom: 40px; color: #1A1A1A;">Личный кабинет</h1>
    
    <div style="display: flex; flex-wrap: wrap; gap: 32px; justify-content: center;">
        <!-- Левая колонка - информация о пользователе -->
        <div style="flex: 0 0 380px;">
            <div style="background: #FFFFFF; border-radius: 24px; padding: 32px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
                <div style="margin-bottom: 24px;">
                    <h2 style="font-size: 1.5rem; font-weight: bold; color: #1A1A1A; margin-bottom: 8px;">{{ $user->name }}</h2>
                    <p style="color: #888888; font-size: 0.875rem;">{{ $user->email }}</p>
                </div>
                
                <div style="border-top: 1px solid #F0E4E8; padding-top: 20px;">
                    <div style="margin-bottom: 16px;">
                        <p style="color: #888888; font-size: 0.75rem; margin-bottom: 4px;">Телефон</p>
                        <p style="color: #1A1A1A;">{{ $user->phone ?? 'Не указан' }}</p>
                    </div>
                    <div style="margin-bottom: 16px;">
                        <p style="color: #888888; font-size: 0.75rem; margin-bottom: 4px;">Адрес</p>
                        <p style="color: #1A1A1A;">{{ $user->address ?? 'Не указан' }}</p>
                    </div>
                    <div>
                        <p style="color: #888888; font-size: 0.75rem; margin-bottom: 4px;">Дата регистрации</p>
                        <p style="color: #1A1A1A;">{{ $user->created_at->format('d.m.Y') }}</p>
                    </div>
                </div>
                
                <a href="{{ route('profile.edit') }}" style="display: block; text-align: center; margin-top: 24px; padding: 12px; background: #D26F8B; color: #FFFFFF; text-decoration: none; border-radius: 40px; transition: all 0.3s;">
                    Редактировать профиль
                </a>
            </div>
        </div>
        
        <!-- Правая колонка - история заказов -->
        <div style="flex: 1; min-width: 500px;">
            <div style="background: #FFFFFF; border-radius: 24px; padding: 32px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
                <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 24px; color: #1A1A1A;">История заказов</h2>
                
                @if($orders->count() > 0)
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="border-bottom: 1px solid #F0E4E8; text-align: left;">
                                    <th style="padding: 12px 8px; color: #888888;">№ заказа</th>
                                    <th style="padding: 12px 8px; color: #888888;">Дата</th>
                                    <th style="padding: 12px 8px; color: #888888;">Сумма</th>
                                    <th style="padding: 12px 8px; color: #888888;">Статус</th>
                                    <th style="padding: 12px 8px; color: #888888;"></th>
                                 </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr style="border-bottom: 1px solid #F0E4E8;">
                                    <td style="padding: 12px 8px; color: #1A1A1A;">{{ $order->order_number }}</td>
                                    <td style="padding: 12px 8px; color: #4A4A4A;">{{ $order->created_at->format('d.m.Y') }}</td>
                                    <td style="padding: 12px 8px; color: #D26F8B; font-weight: 600;">{{ number_format($order->total_amount, 0, ',', ' ') }} ₽</td>
                                    <td style="padding: 12px 8px;">
                                        @if($order->status == 'new')
                                            <span style="background: rgba(210, 111, 139, 0.1); color: #D26F8B; padding: 4px 8px; border-radius: 8px; font-size: 0.75rem;">Новый</span>
                                        @elseif($order->status == 'processing')
                                            <span style="background: rgba(212, 175, 55, 0.1); color: #D4AF37; padding: 4px 8px; border-radius: 8px; font-size: 0.75rem;">В обработке</span>
                                        @elseif($order->status == 'completed')
                                            <span style="background: rgba(74, 124, 89, 0.1); color: #4A7C59; padding: 4px 8px; border-radius: 8px; font-size: 0.75rem;">Выполнен</span>
                                        @else
                                            <span style="background: rgba(229, 57, 53, 0.1); color: #E53935; padding: 4px 8px; border-radius: 8px; font-size: 0.75rem;">Отменен</span>
                                        @endif
                                    </td>
                                 </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div style="margin-top: 24px;">
                        <div style="display: flex; justify-content: center; align-items: center; gap: 8px; flex-wrap: wrap;">
                            {{-- Previous Page Link --}}
                            @if ($orders->onFirstPage())
                                <span style="padding: 8px 16px; background: #F5F0F2; border: 1px solid #F0E4E8; border-radius: 8px; color: #AAAAAA; cursor: not-allowed; font-size: 0.875rem;">
                                    ← Назад
                                </span>
                            @else
                                <a href="{{ $orders->previousPageUrl() }}" style="padding: 8px 16px; background: #FFFFFF; border: 1px solid #F0E4E8; border-radius: 8px; color: #D26F8B; text-decoration: none; transition: all 0.3s; font-size: 0.875rem;">
                                    ← Назад
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($orders->links()->elements as $element)
                                @if (is_string($element))
                                    <span style="padding: 8px 12px; color: #AAAAAA; font-size: 0.875rem;">{{ $element }}</span>
                                @endif

                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $orders->currentPage())
                                            <span style="padding: 8px 16px; background: #D26F8B; color: #FFFFFF; border-radius: 8px; font-weight: 600; font-size: 0.875rem;">{{ $page }}</span>
                                        @else
                                            <a href="{{ $url }}" style="padding: 8px 16px; background: #FFFFFF; border: 1px solid #F0E4E8; border-radius: 8px; color: #4A4A4A; text-decoration: none; transition: all 0.3s; font-size: 0.875rem;">
                                                {{ $page }}
                                            </a>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($orders->hasMorePages())
                                <a href="{{ $orders->nextPageUrl() }}" style="padding: 8px 16px; background: #FFFFFF; border: 1px solid #F0E4E8; border-radius: 8px; color: #D26F8B; text-decoration: none; transition: all 0.3s; font-size: 0.875rem;">
                                    Вперед →
                                </a>
                            @else
                                <span style="padding: 8px 16px; background: #F5F0F2; border: 1px solid #F0E4E8; border-radius: 8px; color: #AAAAAA; cursor: not-allowed; font-size: 0.875rem;">
                                    Вперед →
                                </span>
                            @endif
                        </div>
                    </div>
                @else
                    <div style="text-align: center; padding: 40px 0;">
                        <p style="color: #888888;">У вас пока нет заказов</p>
                        <a href="{{ route('catalog.index') }}" style="display: inline-block; margin-top: 16px; color: #D26F8B; text-decoration: none;">Перейти в каталог</a>
                    </div>
                @endif
            </div>
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
    
    @media (max-width: 1024px) {
        .container {
            padding: 0 20px;
        }
        [style*="flex: 0 0 380px;"] {
            flex: 1 !important;
        }
        [style*="min-width: 500px;"] {
            min-width: auto !important;
            flex: 1 !important;
        }
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 0 16px;
        }
        h1 {
            font-size: 1.75rem !important;
            text-align: center;
        }
        [style*="display: flex; flex-wrap: wrap; gap: 32px; justify-content: center;"] {
            flex-direction: column !important;
        }
    }
    
    a[href="{{ route('profile.edit') }}"]:hover {
        background: #E89BB3 !important;
        transform: translateY(-2px);
    }
    
    .pagination a:hover {
        background: #D26F8B !important;
        color: #FFFFFF !important;
    }
</style>
@endsection