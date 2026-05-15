@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    <h1 style="font-size: 2.5rem; font-weight: bold; margin-bottom: 40px; color: #1A1A1A;">Корзина</h1>
    
    <div id="cart-container">
        @if(count($items) > 0)
            <div style="display: grid; grid-template-columns: 1fr; gap: 32px; lg:grid-template-columns: 2fr 1fr;">
                <div>
                    <div style="background: #FFFFFF; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead style="border-bottom: 1px solid #F0E4E8;">
                                    <tr style="text-align: left;">
                                        <th style="padding: 16px; color: #888888;">Товар</th>
                                        <th style="padding: 16px; color: #888888;">Цена</th>
                                        <th style="padding: 16px; color: #888888;">Количество</th>
                                        <th style="padding: 16px; color: #888888;">Сумма</th>
                                        <th style="padding: 16px;"></th>
                                     </tr>
                                </thead>
                                <tbody id="cart-items">
                                    @foreach($items as $item)
                                    <tr style="border-bottom: 1px solid #F0E4E8;" id="cart-item-{{ $item['id'] }}">
                                        <td style="padding: 16px;">
                                            <div style="display: flex; align-items: center; gap: 16px;">
                                                <div style="width: 64px; height: 64px; background: #FAF8F9; border-radius: 12px; overflow: hidden; flex-shrink: 0;">
                                                    <img src="{{ App\Helpers\ImageHelper::getFlowerImage($item['image'] ?? '') }}" 
                                                         alt="{{ $item['name'] }}"
                                                         style="width: 100%; height: 100%; object-fit: cover;">
                                                </div>
                                                <span style="font-weight: 600; color: #1A1A1A;">{{ $item['name'] }}</span>
                                            </div>
                                         </td>
                                        <td style="padding: 16px; color: #4A4A4A;" class="price-cell">{{ number_format($item['price'], 0, ',', ' ') }} ₽</td>
                                        <td style="padding: 16px;">
                                            <div style="display: flex; align-items: center; border: 1px solid #F0E4E8; border-radius: 40px; width: fit-content;">
                                                <button class="btn-decrease" style="padding: 8px 12px; font-size: 1.25rem; background: transparent; border: none; color: #D26F8B; cursor: pointer; transition: all 0.3s; border-radius: 40px 0 0 40px;" data-id="{{ $item['id'] }}">-</button>
                                                <span class="quantity-display" style="width: 48px; text-align: center; color: #1A1A1A;" data-id="{{ $item['id'] }}">{{ $item['quantity'] }}</span>
                                                <button class="btn-increase" style="padding: 8px 12px; font-size: 1.25rem; background: transparent; border: none; color: #D26F8B; cursor: pointer; transition: all 0.3s; border-radius: 0 40px 40px 0;" data-id="{{ $item['id'] }}">+</button>
                                            </div>
                                         </td>
                                        <td style="padding: 16px; font-weight: 600; color: #D26F8B;" class="total-cell" data-id="{{ $item['id'] }}">{{ number_format($item['total'], 0, ',', ' ') }} ₽</td>
                                        <td style="padding: 16px;">
                                            <button class="btn-remove" style="background: transparent; border: none; color: #E53935; cursor: pointer; transition: all 0.3s; padding: 8px;" data-id="{{ $item['id'] }}">
                                                <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                         </td>
                                     </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div style="margin-top: 16px;">
                        <a href="{{ route('catalog.index') }}" style="display: inline-flex; align-items: center; color: #D26F8B; text-decoration: none; transition: color 0.3s;">
                            <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Продолжить покупки
                        </a>
                    </div>
                </div>
                
                <div>
                    <div style="background: #FFFFFF; border-radius: 20px; padding: 24px; position: sticky; top: 100px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
                        <h3 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 16px; color: #1A1A1A;">Итого</h3>
                        <div style="margin-bottom: 24px;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                                <span style="color: #666666;">Товаров (<span id="cart-count">{{ $count }}</span> шт.)</span>
                                <span id="cart-total" style="color: #1A1A1A;">{{ number_format($total, 0, ',', ' ') }} ₽</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 0.875rem; color: #888888;">
                                <span>Доставка</span>
                                <span>Рассчитывается при оформлении</span>
                            </div>
                        </div>
                        <div style="border-top: 1px solid #F0E4E8; padding-top: 16px; margin-bottom: 24px;">
                            <div style="display: flex; justify-content: space-between; font-size: 1.25rem; font-weight: bold;">
                                <span style="color: #1A1A1A;">К оплате:</span>
                                <span id="cart-grand-total" style="color: #D26F8B;">{{ number_format($total, 0, ',', ' ') }} ₽</span>
                            </div>
                        </div>
                        <a href="{{ route('order.checkout') }}" style="display: block; width: 100%; background: #D26F8B; color: #FFFFFF; font-weight: 600; text-align: center; padding: 12px 24px; border-radius: 40px; text-decoration: none; transition: all 0.3s;">
                            Оформить заказ
                        </a>
                    </div>
                </div>
            </div>

            {{-- Промокод --}}
<div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid #F0E4E8;">
    @if(!isset($appliedPromocode))
        <div id="promocode-section">
            <div style="display: flex; gap: 10px;">
                <input type="text" 
                       id="promocode-input" 
                       placeholder="Введите промокод" 
                       style="flex: 1; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 40px; padding: 10px 16px; color: #1A1A1A;">
                <button id="apply-promocode" 
                        style="background: #D26F8B; color: white; border: none; padding: 10px 20px; border-radius: 40px; cursor: pointer; transition: all 0.3s;">
                    Применить
                </button>
            </div>
            <p style="color: #888888; font-size: 0.7rem; margin-top: 8px;">Промокоды доступны только авторизованным пользователям</p>
            <div id="promocode-message" style="margin-top: 8px; font-size: 0.8rem;"></div>
        </div>
    @else
        <div id="promocode-applied" style="background: rgba(210, 111, 139, 0.1); border-radius: 40px; padding: 10px 16px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <span style="color: #D26F8B; font-weight: 600;">Промокод применен:</span>
                <span style="color: #1A1A1A; margin-left: 8px;">{{ $appliedPromocode['code'] }}</span>
                <span style="color: #4A7C59; margin-left: 8px;">(скидка {{ $appliedPromocode['type'] == 'percent' ? $appliedPromocode['value'] . '%' : number_format($appliedPromocode['discount'], 0, ',', ' ') . ' ₽' }})</span>
            </div>
            <button id="remove-promocode" style="background: transparent; border: none; color: #E53935; cursor: pointer; font-size: 0.8rem;">✕</button>
        </div>
    @endif
</div>
        @else
            <div style="text-align: center; padding: 80px 0;">
                <svg style="width: 96px; height: 96px; margin: 0 auto 24px; color: #D26F8B; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 16px; color: #1A1A1A;">Корзина пуста</h2>
                <p style="color: #888888; margin-bottom: 32px;">Добавьте товары в корзину, чтобы оформить заказ</p>
                <a href="{{ route('catalog.index') }}" style="display: inline-block; background: #D26F8B; color: #FFFFFF; font-weight: 600; padding: 12px 32px; border-radius: 40px; text-decoration: none; transition: all 0.3s;">
                    Перейти в каталог
                </a>
            </div>
        @endif
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
            font-size: 1.75rem !important;
        }
        table {
            font-size: 0.875rem;
        }
        td, th {
            padding: 12px !important;
        }
    }
    
    .btn-decrease:hover, .btn-increase:hover {
        background: rgba(210, 111, 139, 0.1) !important;
    }
    
    .btn-remove:hover {
        color: #E53935 !important;
        opacity: 0.7;
    }
    
    a[href="{{ route('catalog.index') }}"]:hover {
        color: #E89BB3 !important;
    }
    
    a[href="{{ route('order.checkout') }}"]:hover {
        background: #E89BB3 !important;
        transform: translateY(-2px);
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Скрипт корзины загружен');
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';
    
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
                
                const totalElement = document.getElementById('cart-total');
                const grandTotalElement = document.getElementById('cart-grand-total');
                const countElement = document.getElementById('cart-count');
                
                if (totalElement) totalElement.textContent = data.total.toLocaleString('ru-RU') + ' ₽';
                if (grandTotalElement) grandTotalElement.textContent = data.total.toLocaleString('ru-RU') + ' ₽';
                if (countElement) countElement.textContent = data.count;
                
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
    
    document.querySelectorAll('.btn-remove').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.getAttribute('data-id');
            if (confirm('Удалить этот товар из корзины?')) {
                updateCart(id, 'remove');
            }
        });
    });
    
    console.log('Обработчики кнопок установлены');
    console.log('Найдено кнопок увеличения:', document.querySelectorAll('.btn-increase').length);
    console.log('Найдено кнопок уменьшения:', document.querySelectorAll('.btn-decrease').length);
    console.log('Найдено кнопок удаления:', document.querySelectorAll('.btn-remove').length);
});

document.addEventListener('DOMContentLoaded', function() {
    const applyBtn = document.getElementById('apply-promocode');
    const promocodeInput = document.getElementById('promocode-input');
    const messageDiv = document.getElementById('promocode-message');
    
    if (applyBtn) {
        applyBtn.addEventListener('click', async function() {
            const code = promocodeInput.value.trim();
            
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
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ code: code })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    messageDiv.innerHTML = '<span style="color: #4A7C59;">✓ ' + data.message + '</span>';
                    // Обновляем итоговую сумму
                    const totalElement = document.getElementById('cart-grand-total');
                    if (totalElement) {
                        totalElement.textContent = data.total.toLocaleString('ru-RU') + ' ₽';
                    }
                    // Перезагружаем страницу для обновления интерфейса
                    setTimeout(() => window.location.reload(), 1500);
                } else {
                    messageDiv.innerHTML = '<span style="color: #E53935;">✗ ' + data.message + '</span>';
                }
            } catch (error) {
                console.error('Ошибка:', error);
                messageDiv.innerHTML = '<span style="color: #E53935;">Ошибка при проверке промокода</span>';
            }
        });
    }
});

</script>
@endsection