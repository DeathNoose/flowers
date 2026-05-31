@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
<div class="cart-page">
    <div class="container">
        <h1 class="page-title">Корзина</h1>
        
        <div id="cart-container">
            @if(count($items) > 0)
                <div class="cart-grid">
                    {{-- Левая колонка: список товаров --}}
                    <div class="cart-items">
                        <div class="cart-table-wrapper">
                            <table class="cart-table">
                                <thead>
                                    <tr>
                                        <th>Товар</th>
                                        <th>Цена</th>
                                        <th>Количество</th>
                                        <th>Сумма</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="cart-items">
                                    @foreach($items as $item)
                                    <tr id="cart-item-{{ $item['id'] }}">
                                        <td data-label="Товар">
                                            <div class="product-info">
                                                <div class="product-image">
                                                    <img src="{{ App\Helpers\ImageHelper::getFlowerImage($item['image'] ?? '') }}" 
                                                         alt="{{ $item['name'] }}">
                                                </div>
                                                <span class="product-name">{{ $item['name'] }}</span>
                                            </div>
                                        </td>
                                        <td data-label="Цена" class="price-cell">{{ number_format($item['price'], 0, ',', ' ') }} ₽</td>
                                        <td data-label="Количество">
                                            <div class="quantity-control">
                                                <button class="btn-decrease" data-id="{{ $item['id'] }}">-</button>
                                                <span class="quantity-display" data-id="{{ $item['id'] }}">{{ $item['quantity'] }}</span>
                                                <button class="btn-increase" data-id="{{ $item['id'] }}">+</button>
                                            </div>
                                        </td>
                                        <td data-label="Сумма" class="total-cell" data-id="{{ $item['id'] }}">{{ number_format($item['total'], 0, ',', ' ') }} ₽</td>
                                        <td data-label="">
                                            <button class="btn-remove" data-id="{{ $item['id'] }}" title="Удалить">
                                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="continue-shopping">
                            <a href="{{ route('catalog.index') }}" class="continue-link">
                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Продолжить покупки
                            </a>
                        </div>
                    </div>
                    
                    {{-- Правая колонка: итоги и промокод --}}
                    <div class="cart-summary">
                        <div class="summary-card">
                            <h3 class="summary-title">Итого</h3>
                            
                            <div class="summary-row">
                                <span>Товаров (<span id="cart-count">{{ $count }}</span> шт.)</span>
                                <span id="cart-subtotal">{{ number_format($total, 0, ',', ' ') }} ₽</span>
                            </div>
                            
                            @if(isset($appliedPromocode) && $appliedPromocode['discount'] > 0)
                            <div class="summary-row discount">
                                <span>Скидка по промокоду:</span>
                                <span id="cart-discount">- {{ number_format($appliedPromocode['discount'], 0, ',', ' ') }} ₽</span>
                            </div>
                            @endif
                            
                            <div class="summary-row delivery">
                                <span>Доставка:</span>
                                <span id="cart-delivery">550 ₽</span>
                            </div>
                            
                            <div class="summary-divider"></div>
                            
                            <div class="summary-row grand-total">
                                <span>К оплате:</span>
                                <span id="cart-grand-total">{{ number_format($total + 550 - (isset($appliedPromocode) ? $appliedPromocode['discount'] : 0), 0, ',', ' ') }} ₽</span>
                            </div>
                            
                            <a href="{{ route('order.checkout') }}" class="checkout-btn">
                                Оформить заказ
                            </a>
                        </div>
                        
                        {{-- Промокод --}}
                        <div class="promo-card">
                            <h4 class="promo-title">Промокод</h4>
                            
                            @if(!isset($appliedPromocode))
                                <div id="promocode-section">
                                    <div class="promo-input-group">
                                        <input type="text" id="promocode-input" placeholder="Введите промокод">
                                        <button id="apply-promocode">Применить</button>
                                    </div>
                                    <p class="promo-note">Промокод <strong>FF4526</strong> - скидка 10% на первый заказ</p>
                                    <div id="promocode-message"></div>
                                </div>
                            @else
                                <div id="promocode-applied" class="promo-applied">
                                    <div>
                                        <span class="promo-label">Промокод применен:</span>
                                        <span class="promo-code">{{ $appliedPromocode['code'] }}</span>
                                        <span class="promo-discount">(скидка {{ $appliedPromocode['type'] == 'percent' ? $appliedPromocode['value'] . '%' : number_format($appliedPromocode['discount'], 0, ',', ' ') . ' ₽' }})</span>
                                    </div>
                                    <button id="remove-promocode" class="promo-remove">✕</button>
                                </div>
                            @endif
                        </div>
                        
                        {{-- Блок "Первый заказ" - виден только для неавторизованных пользователей --}}
                        @guest
                        <div class="first-order-promo">
                            <div class="promo-icon">🎁</div>
                            <div class="promo-content">
                                <h4>Первый заказ — скидка 10%!</h4>
                                <p>Используйте промокод <strong style="color: #D26F8B;">FF4526</strong> при первом заказе</p>
                            </div>
                        </div>
                        @endguest
                    </div>
                </div>
            @else
                <div class="empty-cart">
                    <svg width="96" height="96" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h2>Корзина пуста</h2>
                    <p>Добавьте товары в корзину, чтобы оформить заказ</p>
                    <a href="{{ route('catalog.index') }}" class="btn-catalog">Перейти в каталог</a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Основные стили страницы */
    .cart-page {
        padding: 60px 0 80px;
    }
    
    .container {
        max-width: 1400px;
        width: 100%;
        margin: 0 auto;
        padding: 0 40px;
    }
    
    .page-title {
        font-size: clamp(1.8rem, 5vw, 2.5rem);
        font-weight: bold;
        margin-bottom: 40px;
        color: #1A1A1A;
    }
    
    /* Сетка */
    .cart-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 40px;
        align-items: start;
    }
    
    /* Таблица товаров */
    .cart-table-wrapper {
        background: #FFFFFF;
        border-radius: 20px;
        overflow-x: auto;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #F0E4E8;
    }
    
    .cart-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 600px;
    }
    
    .cart-table th {
        text-align: left;
        padding: 16px;
        color: #888888;
        font-weight: 500;
        border-bottom: 1px solid #F0E4E8;
    }
    
    .cart-table td {
        padding: 16px;
        border-bottom: 1px solid #F0E4E8;
        vertical-align: middle;
    }
    
    .product-info {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    
    .product-image {
        width: 64px;
        height: 64px;
        background: #FAF8F9;
        border-radius: 12px;
        overflow: hidden;
        flex-shrink: 0;
    }
    
    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .product-name {
        font-weight: 600;
        color: #1A1A1A;
    }
    
    /* Контрол количества */
    .quantity-control {
        display: flex;
        align-items: center;
        border: 1px solid #F0E4E8;
        border-radius: 40px;
        width: fit-content;
    }
    
    .quantity-control button {
        padding: 8px 12px;
        font-size: 1.25rem;
        background: transparent;
        border: none;
        color: #D26F8B;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .quantity-control .btn-decrease {
        border-radius: 40px 0 0 40px;
    }
    
    .quantity-control .btn-increase {
        border-radius: 0 40px 40px 0;
    }
    
    .quantity-control button:hover {
        background: rgba(210, 111, 139, 0.1);
    }
    
    .quantity-display {
        width: 48px;
        text-align: center;
        color: #1A1A1A;
    }
    
    .btn-remove {
        background: transparent;
        border: none;
        color: #E53935;
        cursor: pointer;
        padding: 8px;
        transition: opacity 0.3s;
    }
    
    .btn-remove:hover {
        opacity: 0.7;
    }
    
    .price-cell, .total-cell {
        font-weight: 500;
        color: #4A4A4A;
    }
    
    .total-cell {
        color: #D26F8B;
        font-weight: 600;
    }
    
    /* Продолжить покупки */
    .continue-shopping {
        margin-top: 16px;
    }
    
    .continue-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #D26F8B;
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .continue-link:hover {
        color: #E89BB3;
    }
    
    /* Карточка итогов */
    .summary-card {
        background: #FFFFFF;
        border-radius: 20px;
        padding: 24px;
        position: sticky;
        top: 100px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #F0E4E8;
        margin-bottom: 20px;
    }
    
    .summary-title {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 20px;
        color: #1A1A1A;
    }
    
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        color: #666666;
    }
    
    .summary-row.discount {
        color: #4CAF50;
    }
    
    .summary-row.delivery {
        color: #D26F8B;
        font-weight: 500;
    }
    
    .summary-divider {
        border-top: 1px solid #F0E4E8;
        margin: 16px 0;
    }
    
    .grand-total {
        font-size: 1.25rem;
        font-weight: bold;
        color: #1A1A1A;
    }
    
    .grand-total span:last-child {
        color: #D26F8B;
    }
    
    .checkout-btn {
        display: block;
        width: 100%;
        background: #D26F8B;
        color: #FFFFFF;
        font-weight: 600;
        text-align: center;
        padding: 12px 24px;
        border-radius: 40px;
        text-decoration: none;
        transition: all 0.3s;
        margin-top: 16px;
    }
    
    .checkout-btn:hover {
        background: #E89BB3;
        transform: translateY(-2px);
    }
    
    /* Промокод карточка */
    .promo-card {
        background: #FFFFFF;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #F0E4E8;
        margin-bottom: 20px;
    }
    
    .promo-title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 12px;
        color: #1A1A1A;
    }
    
    .promo-input-group {
        display: flex;
        gap: 10px;
    }
    
    .promo-input-group input {
        flex: 1;
        background: #FAF8F9;
        border: 1px solid #F0E4E8;
        border-radius: 40px;
        padding: 10px 16px;
        color: #1A1A1A;
        font-size: 0.9rem;
    }
    
    .promo-input-group input:focus {
        border-color: #D26F8B;
        outline: none;
    }
    
    .promo-input-group button {
        background: #D26F8B;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 40px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .promo-input-group button:hover {
        background: #E89BB3;
    }
    
    .promo-note {
        color: #888888;
        font-size: 0.7rem;
        margin-top: 8px;
    }
    
    .promo-note strong {
        color: #D26F8B;
        font-weight: 600;
    }
    
    #promocode-message {
        margin-top: 8px;
        font-size: 0.8rem;
    }
    
    .promo-applied {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: rgba(210, 111, 139, 0.1);
        border-radius: 40px;
        padding: 10px 16px;
    }
    
    .promo-label {
        color: #D26F8B;
        font-weight: 600;
    }
    
    .promo-code {
        color: #1A1A1A;
        margin-left: 8px;
    }
    
    .promo-discount {
        color: #4A7C59;
        margin-left: 8px;
    }
    
    .promo-remove {
        background: transparent;
        border: none;
        color: #E53935;
        cursor: pointer;
        font-size: 1rem;
        transition: opacity 0.3s;
    }
    
    .promo-remove:hover {
        opacity: 0.7;
    }
    
    /* Блок "Первый заказ" */
    .first-order-promo {
        background: linear-gradient(135deg, #FFF5F7 0%, #FFF0F3 100%);
        border-radius: 20px;
        padding: 20px;
        display: flex;
        gap: 16px;
        align-items: center;
        border: 1px solid #F0E4E8;
    }
    
    .promo-icon {
        font-size: 2.5rem;
    }
    
    .promo-content h4 {
        font-size: 1rem;
        font-weight: 700;
        color: #D26F8B;
        margin-bottom: 4px;
    }
    
    .promo-content p {
        font-size: 0.8rem;
        color: #666666;
        margin: 0;
    }
    
    .promo-content strong {
        color: #D26F8B;
        font-weight: 700;
    }
    
    /* Пустая корзина */
    .empty-cart {
        text-align: center;
        padding: 80px 0;
    }
    
    .empty-cart svg {
        width: 96px;
        height: 96px;
        margin: 0 auto 24px;
        color: #D26F8B;
        opacity: 0.5;
    }
    
    .empty-cart h2 {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 16px;
        color: #1A1A1A;
    }
    
    .empty-cart p {
        color: #888888;
        margin-bottom: 32px;
    }
    
    .btn-catalog {
        display: inline-block;
        background: #D26F8B;
        color: #FFFFFF;
        font-weight: 600;
        padding: 12px 32px;
        border-radius: 40px;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .btn-catalog:hover {
        background: #E89BB3;
        transform: translateY(-2px);
    }
    
    /* ===== АДАПТИВНОСТЬ ===== */
    
    @media (max-width: 1024px) {
        .container {
            padding: 0 30px;
        }
        
        .cart-grid {
            gap: 30px;
        }
    }
    
    @media (max-width: 768px) {
        .cart-page {
            padding: 40px 0 60px;
        }
        
        .container {
            padding: 0 20px;
        }
        
        .cart-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }
        
        .summary-card {
            position: static;
        }
        
        .cart-table thead {
            display: none;
        }
        
        .cart-table tr {
            display: block;
            margin-bottom: 16px;
            border-bottom: 1px solid #F0E4E8;
        }
        
        .cart-table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: right;
            padding: 12px;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .cart-table td::before {
            content: attr(data-label);
            font-weight: 500;
            color: #888888;
            text-align: left;
        }
        
        .product-info {
            justify-content: flex-end;
            width: 100%;
        }
        
        .quantity-control {
            margin-left: auto;
        }
        
        .btn-remove {
            margin-left: auto;
        }
        
        .first-order-promo {
            flex-direction: row;
            text-align: left;
        }
    }
    
    @media (max-width: 640px) {
        .product-info {
            flex-direction: column;
            text-align: center;
        }
        
        .product-image {
            width: 80px;
            height: 80px;
        }
        
        .cart-table td {
            flex-direction: column;
            text-align: center;
        }
        
        .cart-table td::before {
            margin-bottom: 8px;
        }
        
        .quantity-control {
            margin: 0 auto;
        }
        
        .btn-remove {
            margin: 0 auto;
        }
        
        .first-order-promo {
            flex-direction: column;
            text-align: center;
        }
        
        .promo-input-group {
            flex-direction: column;
        }
        
        .promo-input-group button {
            width: 100%;
        }
    }
    
    @media (max-width: 480px) {
        .container {
            padding: 0 15px;
        }
        
        .cart-page {
            padding: 30px 0 50px;
        }
        
        .page-title {
            margin-bottom: 30px;
            font-size: 1.8rem;
        }
        
        .product-image {
            width: 60px;
            height: 60px;
        }
        
        .product-name {
            font-size: 0.85rem;
        }
        
        .quantity-control button {
            padding: 6px 10px;
        }
        
        .quantity-display {
            width: 40px;
        }
        
        .summary-card, .promo-card {
            padding: 16px;
        }
        
        .first-order-promo {
            padding: 16px;
        }
        
        .promo-icon {
            font-size: 2rem;
        }
        
        .checkout-btn {
            padding: 10px 20px;
        }
    }
    
    @media (max-width: 360px) {
        .product-image {
            width: 50px;
            height: 50px;
        }
        
        .product-name {
            font-size: 0.75rem;
        }
        
        .price-cell, .total-cell {
            font-size: 0.8rem;
        }
        
        .summary-title {
            font-size: 1.1rem;
        }
        
        .grand-total {
            font-size: 1.1rem;
        }
        
        .promo-content h4 {
            font-size: 0.9rem;
        }
        
        .promo-content p {
            font-size: 0.7rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';
    
    // Функция обновления итоговой суммы
    function updateGrandTotal(subtotal, discount = 0) {
        const delivery = 550;
        const grandTotal = subtotal + delivery - discount;
        document.getElementById('cart-grand-total').textContent = grandTotal.toLocaleString('ru-RU') + ' ₽';
        return grandTotal;
    }
    
    async function updateCart(itemId, action, quantity = null) {
        let url = '';
        let body = {};
        
        if (action === 'update') {
            url = '{{ route("cart.update") }}';
            body = { flower_id: itemId, quantity: quantity };
        } else if (action === 'remove') {
            url = '{{ route("cart.remove") }}';
            body = { flower_id: itemId };
        }
        
        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(body)
            });
            
            const data = await response.json();
            
            if (data.success) {
                if (action === 'remove') {
                    const row = document.getElementById(`cart-item-${itemId}`);
                    if (row) row.remove();
                } else if (action === 'update') {
                    const quantityDisplay = document.querySelector(`.quantity-display[data-id="${itemId}"]`);
                    const totalCell = document.querySelector(`.total-cell[data-id="${itemId}"]`);
                    const priceCell = document.querySelector(`#cart-item-${itemId} .price-cell`);
                    
                    if (quantityDisplay && totalCell && priceCell) {
                        const priceText = priceCell.textContent;
                        const price = parseFloat(priceText.replace(/[^\d]/g, ''));
                        const newTotal = price * quantity;
                        
                        quantityDisplay.textContent = quantity;
                        totalCell.textContent = newTotal.toLocaleString('ru-RU') + ' ₽';
                    }
                }
                
                const subtotalElement = document.getElementById('cart-subtotal');
                const countElement = document.getElementById('cart-count');
                
                if (subtotalElement) subtotalElement.textContent = data.total.toLocaleString('ru-RU') + ' ₽';
                if (countElement) countElement.textContent = data.count;
                
                // Получаем текущую скидку
                let currentDiscount = 0;
                const discountElement = document.getElementById('cart-discount');
                if (discountElement) {
                    const discountText = discountElement.textContent;
                    currentDiscount = parseFloat(discountText.replace(/[^\d]/g, '')) || 0;
                }
                
                updateGrandTotal(data.total, currentDiscount);
                
                const cartBadge = document.querySelector('header a.relative span');
                if (cartBadge) {
                    if (data.count > 0) {
                        cartBadge.textContent = data.count;
                        cartBadge.classList.remove('hidden');
                    } else {
                        cartBadge.classList.add('hidden');
                    }
                }
                
                if (data.count === 0) {
                    window.location.reload();
                }
            }
        } catch (error) {
            console.error('Ошибка:', error);
            alert('Произошла ошибка. Попробуйте обновить страницу.');
        }
    }
    
    // Обработчики увеличения
    document.querySelectorAll('.btn-increase').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.getAttribute('data-id');
            const quantityDisplay = document.querySelector(`.quantity-display[data-id="${id}"]`);
            if (quantityDisplay) {
                const currentQty = parseInt(quantityDisplay.textContent);
                const newQty = currentQty + 1;
                updateCart(id, 'update', newQty);
            }
        });
    });
    
    // Обработчики уменьшения
    document.querySelectorAll('.btn-decrease').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.getAttribute('data-id');
            const quantityDisplay = document.querySelector(`.quantity-display[data-id="${id}"]`);
            if (quantityDisplay) {
                const currentQty = parseInt(quantityDisplay.textContent);
                if (currentQty > 1) {
                    const newQty = currentQty - 1;
                    updateCart(id, 'update', newQty);
                }
            }
        });
    });
    
    // Обработчики удаления
    document.querySelectorAll('.btn-remove').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.getAttribute('data-id');
            if (confirm('Удалить этот товар из корзины?')) {
                updateCart(id, 'remove');
            }
        });
    });
    
    // Применение промокода
    const applyBtn = document.getElementById('apply-promocode');
    const promocodeInput = document.getElementById('promocode-input');
    const messageDiv = document.getElementById('promocode-message');
    
    if (applyBtn) {
        applyBtn.addEventListener('click', async function() {
            const code = promocodeInput.value.trim().toUpperCase();
            
            if (!code) {
                messageDiv.innerHTML = '<span style="color: #E53935;">Введите код промокода</span>';
                return;
            }
            
            messageDiv.innerHTML = '<span style="color: #888888;">Проверка...</span>';
            
            try {
                const response = await fetch('{{ route("cart.apply-promocode") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ code: code })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    messageDiv.innerHTML = '<span style="color: #4A7C59;">✓ ' + data.message + '</span>';
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    messageDiv.innerHTML = '<span style="color: #E53935;">✗ ' + data.message + '</span>';
                }
            } catch (error) {
                console.error('Ошибка:', error);
                messageDiv.innerHTML = '<span style="color: #E53935;">Ошибка при проверке промокода</span>';
            }
        });
    }
    
    // Удаление промокода
    const removePromoBtn = document.getElementById('remove-promocode');
    if (removePromoBtn) {
        removePromoBtn.addEventListener('click', async function() {
            try {
                const response = await fetch('{{ route("cart.remove-promocode") }}', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });
                const data = await response.json();
                if (data.success) {
                    window.location.reload();
                }
            } catch (error) {
                console.error('Ошибка:', error);
            }
        });
    }
});
</script>
@endsection