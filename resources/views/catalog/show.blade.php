@extends('layouts.app')

@section('title', $flower->name)

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 48px;">
{{-- Галерея фото со слайдером --}}
<div>
    <div style="background: #FFFFFF; border-radius: 24px; overflow: hidden; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
        <!-- Главное изображение -->
        <div id="mainImageContainer" style="position: relative; aspect-ratio: 1 / 1; background: #FAF8F9; cursor: pointer;">
            <img id="mainImage" src="{{ \App\Helpers\ImageHelper::getFlowerImage($flower->image_path) }}" 
                 alt="{{ $flower->name }}"
                 style="width: 100%; height: 100%; object-fit: contain;">
        </div>
        
        <!-- Миниатюры (слайдер) -->
        @php
            $allImages = $flower->getAllImages();
        @endphp
        
        @if($allImages->count() > 1)
        <div style="padding: 16px; border-top: 1px solid #F0E4E8;">
            <div style="display: flex; gap: 12px; overflow-x: auto; justify-content: center;">
                @foreach($allImages as $index => $img)
                <div class="thumbnail" data-image="{{ \App\Helpers\ImageHelper::getFlowerImage($img->image_path) }}" 
                     style="width: 70px; height: 70px; border-radius: 12px; overflow: hidden; cursor: pointer; border: 2px solid {{ $index == 0 ? '#D26F8B' : '#F0E4E8' }}; transition: all 0.3s;">
                    <img src="{{ \App\Helpers\ImageHelper::getFlowerImage($img->image_path) }}" 
                         alt="Миниатюра {{ $index+1 }}"
                         style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

        {{-- Информация о товаре --}}
        <div>
            <div style="margin-bottom: 16px;">
                <span style="font-size: 0.875rem; color: #D26F8B; text-transform: uppercase; letter-spacing: 0.5px;">{{ $flower->category->name }}</span>
            </div>
            <h1 style="font-size: 2rem; font-weight: bold; margin-bottom: 16px; color: #1A1A1A;">{{ $flower->name }}</h1>
            
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
                <span style="font-size: 2rem; font-weight: bold; color: #D26F8B;">{{ number_format($flower->price, 0, ',', ' ') }} ₽</span>
                @if($flower->in_stock)
                    <span style="padding: 4px 12px; background: rgba(210, 111, 139, 0.1); color: #D26F8B; border-radius: 20px; font-size: 0.875rem;">В наличии</span>
                @else
                    <span style="padding: 4px 12px; background: rgba(229, 57, 53, 0.1); color: #E53935; border-radius: 20px; font-size: 0.875rem;">Нет в наличии</span>
                @endif
            </div>
            
            <div style="border-top: 1px solid #F0E4E8; padding-top: 24px; margin-bottom: 24px;">
                <h3 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 12px; color: #1A1A1A;">Описание</h3>
                <p style="color: #666666; line-height: 1.6;">{{ $flower->description }}</p>
            </div>

            <div style="border-top: 1px solid #F0E4E8; padding-top: 24px; margin-bottom: 24px;">
                <h3 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 16px; color: #1A1A1A;">Характеристики</h3>
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <div style="display: flex; justify-content: space-between; padding-bottom: 8px; border-bottom: 1px solid #F0E4E8;">
                        <span style="color: #888888;">Состояние:</span>
                        <span style="color: #4A4A4A;">Свежесрезанные цветы</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding-bottom: 8px; border-bottom: 1px solid #F0E4E8;">
                        <span style="color: #888888;">Срок жизни:</span>
                        <span style="color: #4A4A4A;">7-10 дней в вазе</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding-bottom: 8px; border-bottom: 1px solid #F0E4E8;">
                        <span style="color: #888888;">Упаковка:</span>
                        <span style="color: #4A4A4A;">Крафтовая бумага / коробка</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding-bottom: 8px; border-bottom: 1px solid #F0E4E8;">
                        <span style="color: #888888;">Доставка:</span>
                        <span style="color: #4A4A4A;">1-3 часа по городу</span>
                    </div>
                </div>
            </div>

            @if($flower->in_stock)
                <div style="display: flex; flex-direction: column; gap: 16px;">
                    <form action="{{ route('cart.add', $flower) }}" method="POST" style="display: flex; gap: 16px;">
                        @csrf
                        <div style="display: flex; align-items: center; border: 1px solid #F0E4E8; border-radius: 40px;">
                            <button type="button" class="btn-decrease" style="padding: 12px 16px; background: transparent; border: none; color: #D26F8B; font-size: 1.25rem; cursor: pointer; border-radius: 40px 0 0 40px;">-</button>
                            <span class="quantity-display" style="width: 60px; text-align: center; color: #1A1A1A; font-size: 1rem;">1</span>
                            <button type="button" class="btn-increase" style="padding: 12px 16px; background: transparent; border: none; color: #D26F8B; font-size: 1.25rem; cursor: pointer; border-radius: 0 40px 40px 0;">+</button>
                        </div>
                        <input type="hidden" name="quantity" id="quantity" value="1">
                        <button type="submit" style="flex: 1; background: #D26F8B; color: #FFFFFF; font-weight: 600; padding: 12px 24px; border-radius: 40px; border: none; cursor: pointer; transition: all 0.3s;">
                            Добавить в корзину
                        </button>
                    </form>
                </div>
            @else
                <div style="padding: 16px; background: rgba(229, 57, 53, 0.1); border: 1px solid rgba(229, 57, 53, 0.3); border-radius: 12px; text-align: center;">
                    <p style="color: #E53935;">Товар временно отсутствует. Подпишитесь на уведомление о поступлении!</p>
                </div>
            @endif

            <div style="margin-top: 24px; padding: 16px; background: rgba(210, 111, 139, 0.05); border-radius: 12px;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <svg style="width: 20px; height: 20px; color: #D26F8B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7" />
                    </svg>
                    <span style="color: #666666; font-size: 0.875rem;">Бесплатная доставка при заказе от 3000 ₽</span>
                </div>
            </div>
        </div>
    </div>

{{-- Блок "С этим товаром покупают" --}}
@if(isset($related) && $related->count() > 0)
<div style="margin-top: 80px;">
    <div style="text-align: center; margin-bottom: 48px;">
        <h2 style="font-size: 1.75rem; font-weight: bold; color: #1A1A1A;">
            С этим товаром <span style="color: #D26F8B;">покупают</span>
        </h2>
        <div style="width: 60px; height: 3px; background: #D26F8B; margin: 16px auto 0;"></div>
        <p style="color: #888888; margin-top: 12px;">Популярные товары из этой же коллекции</p>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 320px)); gap: 24px; justify-content: center;">
        @foreach($related as $item)
        <div class="related-card" style="background: #FFFFFF; border-radius: 20px; overflow: hidden; transition: all 0.3s ease; border: 1px solid #F0E4E8; display: flex; flex-direction: column;">
            <a href="{{ route('catalog.show', $item) }}" style="display: block; overflow: hidden;">
                <div style="height: 220px; overflow: hidden;">
                    <img src="{{ App\Helpers\ImageHelper::getFlowerImage($item->image_path) }}" 
                         alt="{{ $item->name }}"
                         style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;">
                </div>
            </a>
            <div style="padding: 20px; flex: 1; display: flex; flex-direction: column;">
                <a href="{{ route('catalog.show', $item) }}" style="text-decoration: none;">
                    <h3 style="font-weight: 700; font-size: 1.1rem; margin-bottom: 8px; color: #1A1A1A; transition: color 0.3s; line-height: 1.4;">{{ $item->name }}</h3>
                </a>
                <div style="margin-top: auto; display: flex; justify-content: space-between; align-items: center; padding-top: 16px;">
                    <span style="color: #D26F8B; font-weight: 800; font-size: 1.2rem;">{{ number_format($item->price, 0, ',', ' ') }} ₽</span>
                    <form action="{{ route('cart.add', $item) }}" method="POST">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="related-cart-btn" style="background: #D26F8B; color: white; border: none; padding: 8px 20px; border-radius: 30px; cursor: pointer; font-size: 0.8rem; font-weight: 500; transition: all 0.3s ease;">
                            В корзину
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    /* Адаптивность */
    @media (max-width: 768px) {
        [style*="grid-template-columns: repeat(auto-fit, minmax(280px, 320px))"] {
            grid-template-columns: 1fr !important;
            max-width: 320px;
            margin: 0 auto;
        }
    }
    
    .related-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(210, 111, 139, 0.12);
        border-color: #D26F8B;
    }
    
    .related-card:hover h3 {
        color: #D26F8B;
    }
    
    .related-card:hover img {
        transform: scale(1.05);
    }
    
    .related-cart-btn:hover {
        background: #E89BB3 !important;
        transform: translateY(-2px);
    }
</style>
@endif

<style>
    .container {
        max-width: 1400px;
        width: 100%;
        margin: 0 auto;
        padding: 0 40px;
    }
    
    @media (max-width: 1024px) {
        [style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
            gap: 32px !important;
        }
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 0 20px;
        }
    }
    
    .btn-decrease:hover, .btn-increase:hover {
        background: rgba(210, 111, 139, 0.1);
    }
    
    button[type="submit"]:hover {
        background: #E89BB3 !important;
        transform: translateY(-2px);
    }
    
    .related-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(210, 111, 139, 0.12);
        border-color: #D26F8B;
    }
    
    .related-card:hover h3 {
        color: #D26F8B;
    }
    
    .related-card:hover img {
        transform: scale(1.05);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const decreaseBtn = document.querySelector('.btn-decrease');
    const increaseBtn = document.querySelector('.btn-increase');
    const quantityDisplay = document.querySelector('.quantity-display');
    const quantityInput = document.getElementById('quantity');
    
    if (decreaseBtn && increaseBtn && quantityDisplay && quantityInput) {
        decreaseBtn.addEventListener('click', function(e) {
            e.preventDefault();
            let currentVal = parseInt(quantityDisplay.textContent);
            if (currentVal > 1) {
                let newVal = currentVal - 1;
                quantityDisplay.textContent = newVal;
                quantityInput.value = newVal;
            }
        });
        
        increaseBtn.addEventListener('click', function(e) {
            e.preventDefault();
            let currentVal = parseInt(quantityDisplay.textContent);
            let newVal = currentVal + 1;
            quantityDisplay.textContent = newVal;
            quantityInput.value = newVal;
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Слайдер для переключения изображений
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.getElementById('mainImage');
    
    if (thumbnails.length > 0) {
        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                const newImageSrc = this.getAttribute('data-image');
                mainImage.src = newImageSrc;
                
                // Обновляем активную рамку
                thumbnails.forEach(t => {
                    t.style.borderColor = '#F0E4E8';
                });
                this.style.borderColor = '#D26F8B';
            });
        });
    }
    
    // Клик по главному изображению для открытия в полном размере (опционально)
    if (mainImage) {
        mainImage.style.cursor = 'pointer';
        mainImage.addEventListener('click', function() {
            window.open(this.src, '_blank');
        });
    }
});

</script>
@endsection