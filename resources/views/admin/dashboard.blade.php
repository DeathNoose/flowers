@extends('layouts.app')

@section('title', 'Админ-панель')

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    <div style="margin-bottom: 40px;">
        <h1 style="font-size: 2rem; font-weight: bold; color: #1A1A1A;">Админ-панель</h1>
        <p style="color: #888888;">Управление магазином</p>
    </div>
    
    {{-- Блок статистики (карточки) --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-bottom: 48px;">
        <!-- Статистика: Пользователи -->
        <a href="{{ route('admin.users.index') }}" style="text-decoration: none; display: block;">
            <div style="background: #FFFFFF; border-radius: 20px; padding: 24px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8; transition: all 0.3s ease;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                    <div style="width: 48px; height: 48px; background: rgba(210, 111, 139, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 24px; height: 24px; color: #D26F8B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <span style="font-size: 2rem; font-weight: bold; color: #D26F8B;">{{ $totalUsers }}</span>
                </div>
                <h3 style="color: #1A1A1A; font-weight: 600; margin-bottom: 4px;">Пользователей</h3>
                <p style="color: #888888; font-size: 0.875rem;">Зарегистрировано в системе</p>
            </div>
        </a>
        
        <!-- Статистика: Заказы -->
        <a href="{{ route('admin.orders.index') }}" style="text-decoration: none; display: block;">
            <div style="background: #FFFFFF; border-radius: 20px; padding: 24px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8; transition: all 0.3s ease;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                    <div style="width: 48px; height: 48px; background: rgba(210, 111, 139, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 24px; height: 24px; color: #D26F8B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <span style="font-size: 2rem; font-weight: bold; color: #D26F8B;">{{ $totalOrders }}</span>
                </div>
                <h3 style="color: #1A1A1A; font-weight: 600; margin-bottom: 4px;">Заказов</h3>
                <p style="color: #888888; font-size: 0.875rem;">Всего заказов</p>
            </div>
        </a>
        
        <!-- Статистика: Товары -->
        <a href="{{ route('admin.products.index') }}" style="text-decoration: none; display: block;">
            <div style="background: #FFFFFF; border-radius: 20px; padding: 24px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8; transition: all 0.3s ease;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                    <div style="width: 48px; height: 48px; background: rgba(210, 111, 139, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 24px; height: 24px; color: #D26F8B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <span style="font-size: 2rem; font-weight: bold; color: #D26F8B;">{{ $totalProducts }}</span>
                </div>
                <h3 style="color: #1A1A1A; font-weight: 600; margin-bottom: 4px;">Товаров</h3>
                <p style="color: #888888; font-size: 0.875rem;">В каталоге</p>
            </div>
        </a>
        
        <!-- Статистика: Выручка -->
        <div style="background: #FFFFFF; border-radius: 20px; padding: 24px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                <div style="width: 48px; height: 48px; background: rgba(210, 111, 139, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <svg style="width: 24px; height: 24px; color: #D26F8B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span style="font-size: 2rem; font-weight: bold; color: #D26F8B;">{{ number_format($totalRevenue, 0, ',', ' ') }} ₽</span>
            </div>
            <h3 style="color: #1A1A1A; font-weight: 600; margin-bottom: 4px;">Выручка</h3>
            <p style="color: #888888; font-size: 0.875rem;">Общая сумма заказов</p>
        </div>
    </div>
    
    {{-- Графики заказов и выручки --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 32px; margin-bottom: 48px;">
        <div style="background: #FFFFFF; border-radius: 24px; padding: 24px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
            <h2 style="font-size: 1.25rem; font-weight: bold; color: #1A1A1A; margin-bottom: 20px;">Динамика заказов (7 дней)</h2>
            <canvas id="ordersChart" style="max-height: 300px; width: 100%;"></canvas>
        </div>
        
        <div style="background: #FFFFFF; border-radius: 24px; padding: 24px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
            <h2 style="font-size: 1.25rem; font-weight: bold; color: #1A1A1A; margin-bottom: 20px;">Динамика выручки (7 дней)</h2>
            <canvas id="revenueChart" style="max-height: 300px; width: 100%;"></canvas>
        </div>
    </div>
    
    {{-- Блок аналитики продаж --}}
    <div style="margin-bottom: 48px;">
        <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 24px; color: #1A1A1A;">Аналитика продаж</h2>
        
        {{-- Общая статистика --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 16px; margin-bottom: 32px;">
            <div style="background: #FFFFFF; border-radius: 16px; padding: 20px; border: 1px solid #F0E4E8;">
                <p style="color: #888888; font-size: 0.875rem; margin-bottom: 8px;">Всего продано товаров</p>
                <p style="font-size: 2rem; font-weight: bold; color: #D26F8B;">{{ number_format($totalSoldItems ?? 0, 0, ',', ' ') }} шт.</p>
            </div>
            <div style="background: #FFFFFF; border-radius: 16px; padding: 20px; border: 1px solid #F0E4E8;">
                <p style="color: #888888; font-size: 0.875rem; margin-bottom: 8px;">Средний чек заказа</p>
                <p style="font-size: 2rem; font-weight: bold; color: #D26F8B;">{{ number_format($averageOrderValue ?? 0, 0, ',', ' ') }} ₽</p>
            </div>
        </div>
        
        {{-- Первая строка таблиц --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 24px; margin-bottom: 24px;">
            <!-- Топ-10 самых продаваемых товаров -->
            <div style="background: #FFFFFF; border-radius: 20px; padding: 24px; border: 1px solid #F0E4E8;">
                <h3 style="font-size: 1.125rem; font-weight: bold; margin-bottom: 16px; color: #1A1A1A;">Топ-10 самых продаваемых товаров</h3>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 1px solid #F0E4E8;">
                                <th style="padding: 8px; text-align: left; color: #888888;">Товар</th>
                                <th style="padding: 8px; text-align: center; color: #888888;">Кол-во</th>
                                <th style="padding: 8px; text-align: right; color: #888888;">Выручка</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($popularProducts ?? [] as $product)
                            <tr style="border-bottom: 1px solid #F0E4E8;">
                                <td style="padding: 8px; color: #4A4A4A;">{{ $product->flower_name }}</td>
                                <td style="padding: 8px; text-align: center; color: #1A1A1A; font-weight: 600;">{{ $product->total_quantity }} шт.</td>
                                <td style="padding: 8px; text-align: right; color: #D26F8B;">{{ number_format($product->total_revenue, 0, ',', ' ') }} ₽</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" style="padding: 40px; text-align: center; color: #888888;">Нет данных о продажах</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Топ-10 товаров по выручке -->
            <div style="background: #FFFFFF; border-radius: 20px; padding: 24px; border: 1px solid #F0E4E8;">
                <h3 style="font-size: 1.125rem; font-weight: bold; margin-bottom: 16px; color: #1A1A1A;">Топ-10 товаров по выручке</h3>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 1px solid #F0E4E8;">
                                <th style="padding: 8px; text-align: left; color: #888888;">Товар</th>
                                <th style="padding: 8px; text-align: center; color: #888888;">Кол-во</th>
                                <th style="padding: 8px; text-align: right; color: #888888;">Выручка</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topByRevenue ?? [] as $product)
                            <tr style="border-bottom: 1px solid #F0E4E8;">
                                <td style="padding: 8px; color: #4A4A4A;">{{ $product->flower_name }}</td>
                                <td style="padding: 8px; text-align: center; color: #1A1A1A; font-weight: 600;">{{ $product->total_quantity }} шт.</td>
                                <td style="padding: 8px; text-align: right; color: #D26F8B;">{{ number_format($product->total_revenue, 0, ',', ' ') }} ₽</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" style="padding: 40px; text-align: center; color: #888888;">Нет данных о продажах</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        {{-- Вторая строка таблиц --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 24px; margin-bottom: 24px;">
            <!-- Продажи по категориям -->
            <div style="background: #FFFFFF; border-radius: 20px; padding: 24px; border: 1px solid #F0E4E8;">
                <h3 style="font-size: 1.125rem; font-weight: bold; margin-bottom: 16px; color: #1A1A1A;">Продажи по категориям</h3>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 1px solid #F0E4E8;">
                                <th style="padding: 8px; text-align: left; color: #888888;">Категория</th>
                                <th style="padding: 8px; text-align: center; color: #888888;">Кол-во</th>
                                <th style="padding: 8px; text-align: right; color: #888888;">Выручка</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($salesByCategory ?? [] as $category)
                            <tr style="border-bottom: 1px solid #F0E4E8;">
                                <td style="padding: 8px; color: #4A4A4A;">{{ $category->name }}</td>
                                <td style="padding: 8px; text-align: center; color: #1A1A1A; font-weight: 600;">{{ $category->total_quantity }} шт.</td>
                                <td style="padding: 8px; text-align: right; color: #D26F8B;">{{ number_format($category->total_revenue, 0, ',', ' ') }} ₽</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" style="padding: 40px; text-align: center; color: #888888;">Нет данных о продажах</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Средний чек по товарам -->
            <div style="background: #FFFFFF; border-radius: 20px; padding: 24px; border: 1px solid #F0E4E8;">
                <h3 style="font-size: 1.125rem; font-weight: bold; margin-bottom: 16px; color: #1A1A1A;">Средний чек по товарам</h3>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 1px solid #F0E4E8;">
                                <th style="padding: 8px; text-align: left; color: #888888;">Товар</th>
                                <th style="padding: 8px; text-align: center; color: #888888;">Кол-во покупок</th>
                                <th style="padding: 8px; text-align: right; color: #888888;">Средний чек</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($averageCheck ?? [] as $item)
                            <tr style="border-bottom: 1px solid #F0E4E8;">
                                <td style="padding: 8px; color: #4A4A4A;">{{ $item->flower_name }}</td>
                                <td style="padding: 8px; text-align: center; color: #1A1A1A;">{{ $item->times_purchased }} раз</td>
                                <td style="padding: 8px; text-align: right; color: #D26F8B;">{{ number_format($item->avg_check, 0, ',', ' ') }} ₽</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" style="padding: 40px; text-align: center; color: #888888;">Нет данных о продажах</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Сезонность продаж -->
        <div style="background: #FFFFFF; border-radius: 20px; padding: 24px; border: 1px solid #F0E4E8;">
            <h3 style="font-size: 1.125rem; font-weight: bold; margin-bottom: 16px; color: #1A1A1A;">Сезонность продаж ({{ date('Y') }} год)</h3>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 1px solid #F0E4E8;">
                            <th style="padding: 8px; text-align: left; color: #888888;">Месяц</th>
                            <th style="padding: 8px; text-align: center; color: #888888;">Кол-во заказов</th>
                            <th style="padding: 8px; text-align: right; color: #888888;">Выручка</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
                        @endphp
                        @forelse($monthlySales ?? [] as $sale)
                        <tr style="border-bottom: 1px solid #F0E4E8;">
                            <td style="padding: 8px; color: #4A4A4A;">{{ $months[$sale->month - 1] }}</td>
                            <td style="padding: 8px; text-align: center; color: #1A1A1A; font-weight: 600;">{{ $sale->orders_count }}</td>
                            <td style="padding: 8px; text-align: right; color: #D26F8B;">{{ number_format($sale->revenue, 0, ',', ' ') }} ₽</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="padding: 40px; text-align: center; color: #888888;">Нет данных о продажах за текущий год</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    {{-- Новые заказы --}}
    <div style="background: #FFFFFF; border-radius: 24px; padding: 32px; margin-bottom: 32px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h2 style="font-size: 1.5rem; font-weight: bold; color: #1A1A1A;">Новые заказы</h2>
            <a href="{{ route('admin.orders.index') }}" style="color: #D26F8B; text-decoration: none;">Все заказы →</a>
        </div>
        
        @if($pendingOrders > 0)
            <div style="background: rgba(210, 111, 139, 0.1); border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #D26F8B; font-weight: 600;">Ожидают обработки:</span>
                    <span style="color: #1A1A1A; font-weight: bold; font-size: 1.25rem;">{{ $pendingOrders }}</span>
                </div>
            </div>
        @endif
        
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #F0E4E8; text-align: left;">
                        <th style="padding: 12px 8px; color: #888888;">№ заказа</th>
                        <th style="padding: 12px 8px; color: #888888;">Покупатель</th>
                        <th style="padding: 12px 8px; color: #888888;">Сумма</th>
                        <th style="padding: 12px 8px; color: #888888;">Статус</th>
                        <th style="padding: 12px 8px; color: #888888;">Дата</th>
                        <th style="padding: 12px 8px; color: #888888;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentOrders as $order)
                    <tr style="border-bottom: 1px solid #F0E4E8;">
                        <td style="padding: 12px 8px; color: #1A1A1A;">{{ $order->order_number ?? $order->id }}</td>
                        <td style="padding: 12px 8px; color: #4A4A4A;">{{ $order->customer_name ?? $order->user->name ?? 'Гость' }}</td>
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
                        <td style="padding: 12px 8px; color: #888888;">{{ $order->created_at->format('d.m.Y') }}</td>
                        <td style="padding: 12px 8px;">
                            <a href="{{ route('admin.orders.show', $order) }}" style="color: #D26F8B; text-decoration: none;">Просмотр</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
{{-- Быстрые ссылки --}}
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
    <a href="{{ route('admin.products.index') }}" style="background: #FFFFFF; border-radius: 16px; padding: 20px; text-align: center; text-decoration: none; transition: all 0.3s; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
        <svg style="width: 32px; height: 32px; color: #D26F8B; margin: 0 auto 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
        </svg>
        <span style="color: #1A1A1A;">Товары</span>
    </a>
    
    <a href="{{ route('admin.categories.index') }}" style="background: #FFFFFF; border-radius: 16px; padding: 20px; text-align: center; text-decoration: none; transition: all 0.3s; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
        <svg style="width: 32px; height: 32px; color: #D26F8B; margin: 0 auto 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
        </svg>
        <span style="color: #1A1A1A;">Категории</span>
    </a>
    
    <a href="{{ route('admin.orders.index') }}" style="background: #FFFFFF; border-radius: 16px; padding: 20px; text-align: center; text-decoration: none; transition: all 0.3s; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
        <svg style="width: 32px; height: 32px; color: #D26F8B; margin: 0 auto 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
        </svg>
        <span style="color: #1A1A1A;">Заказы</span>
    </a>
    
    <a href="{{ route('admin.users.index') }}" style="background: #FFFFFF; border-radius: 16px; padding: 20px; text-align: center; text-decoration: none; transition: all 0.3s; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
        <svg style="width: 32px; height: 32px; color: #D26F8B; margin: 0 auto 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        <span style="color: #1A1A1A;">Пользователи</span>
    </a>
    
    <!-- ДОБАВЛЕНО: Промокоды -->
    <a href="{{ route('admin.promocodes.index') }}" style="background: #FFFFFF; border-radius: 16px; padding: 20px; text-align: center; text-decoration: none; transition: all 0.3s; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
        <svg style="width: 32px; height: 32px; color: #D26F8B; margin: 0 auto 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 2C8 2 4 5 4 9c0 5 8 13 8 13s8-8 8-13c0-4-4-7-8-7z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v4m0 4h.01" />
        </svg>
        <span style="color: #1A1A1A;">Промокоды</span>
    </a>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const orderDates = @json($orderDates ?? []);
        const orderCounts = @json($orderCounts ?? []);
        const revenueAmounts = @json($revenueAmounts ?? []);
        
        const revenueNumbers = revenueAmounts.map(value => parseFloat(value) || 0);
        
        const ordersCanvas = document.getElementById('ordersChart');
        const revenueCanvas = document.getElementById('revenueChart');
        
        if (ordersCanvas && orderDates.length > 0) {
            new Chart(ordersCanvas, {
                type: 'bar',
                data: {
                    labels: orderDates,
                    datasets: [{
                        label: 'Количество заказов',
                        data: orderCounts,
                        backgroundColor: 'rgba(210, 111, 139, 0.7)',
                        borderColor: '#D26F8B',
                        borderWidth: 2,
                        borderRadius: 8,
                        barPercentage: 0.6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, ticks: { stepSize: 1, precision: 0 } },
                        x: { ticks: { maxRotation: 45, minRotation: 45 } }
                    }
                }
            });
        }
        
        if (revenueCanvas && orderDates.length > 0) {
            new Chart(revenueCanvas, {
                type: 'line',
                data: {
                    labels: orderDates,
                    datasets: [{
                        label: 'Выручка (₽)',
                        data: revenueNumbers,
                        borderColor: '#4A7C59',
                        backgroundColor: 'rgba(74, 124, 89, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#4A7C59',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true },
                        x: { ticks: { maxRotation: 45, minRotation: 45 } }
                    }
                }
            });
        }
    });
</script>
@endpush