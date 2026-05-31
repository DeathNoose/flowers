@extends('layouts.app')

@section('title', $flower->name)

@section('content')
<div class="product-page">
    <div class="container">
        <div class="product-grid">
            {{-- Галерея фото со слайдером --}}
            <div class="product-gallery">
                <div class="gallery-main">
                    <div id="mainImageContainer" class="main-image-container">
                        <img id="mainImage" src="{{ \App\Helpers\ImageHelper::getFlowerImage($flower->image_path) }}" 
                             alt="{{ $flower->name }}"
                             class="main-image">
                    </div>
                    
                    @php
                        $allImages = $flower->getAllImages();
                    @endphp
                    
                    @if($allImages->count() > 1)
                    <div class="thumbnails-wrapper">
                        <div class="thumbnails-container">
                            @foreach($allImages as $index => $img)
                            <div class="thumbnail" data-image="{{ \App\Helpers\ImageHelper::getFlowerImage($img->image_path) }}">
                                <img src="{{ \App\Helpers\ImageHelper::getFlowerImage($img->image_path) }}" 
                                     alt="Миниатюра {{ $index+1 }}">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Информация о товаре --}}
            <div class="product-info">
                <div class="product-category">
                    <span>{{ $flower->category->name }}</span>
                </div>
                <h1 class="product-title">{{ $flower->name }}</h1>
                
                <div class="product-price-section">
                    <span class="product-price">{{ number_format($flower->price, 0, ',', ' ') }} ₽</span>
                    @if($flower->in_stock)
                        <span class="stock-badge in-stock">В наличии</span>
                    @else
                        <span class="stock-badge out-stock">Нет в наличии</span>
                    @endif
                </div>
                
                <div class="product-description">
                    <h3>Описание</h3>
                    <p>{{ $flower->description }}</p>
                </div>

                <div class="product-specs">
                    <h3>Характеристики</h3>
                    <div class="specs-list">
                        <div class="spec-item">
                            <span class="spec-label">Состояние:</span>
                            <span class="spec-value">Свежесрезанные цветы</span>
                        </div>
                        <div class="spec-item">
                            <span class="spec-label">Срок жизни:</span>
                            <span class="spec-value">7-10 дней в вазе</span>
                        </div>
                        <div class="spec-item">
                            <span class="spec-label">Доставка:</span>
                            <span class="spec-value">1-3 часа по городу</span>
                        </div>
                    </div>
                </div>

                @if($flower->in_stock)
                    <div class="product-actions">
                        <form action="{{ route('cart.add', $flower) }}" method="POST" class="add-to-cart-form">
                            @csrf
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn btn-decrease">-</button>
                                <span class="quantity-display">1</span>
                                <button type="button" class="quantity-btn btn-increase">+</button>
                            </div>
                            <input type="hidden" name="quantity" id="quantity" value="1">
                            <button type="submit" class="add-to-cart-btn">Добавить в корзину</button>
                        </form>
                    </div>
                @else
                    <div class="out-of-stock-message">
                        <p>Товар временно отсутствует. Подпишитесь на уведомление о поступлении!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
/* Reset и базовые стили */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.product-page {
    min-height: calc(100vh - 400px);
    padding: 60px 0 80px;
    background: #FFFFFF;
}

.container {
    max-width: 1400px;
    width: 100%;
    margin: 0 auto;
    padding: 0 40px;
}

/* Основная сетка */
.product-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 48px;
}

/* Галерея */
.product-gallery {
    width: 100%;
}

.gallery-main {
    background: #FFFFFF;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    border: 1px solid #F0E4E8;
}

.main-image-container {
    position: relative;
    aspect-ratio: 1 / 1;
    background: #FAF8F9;
    cursor: pointer;
    overflow: hidden;
}

.main-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: transform 0.3s ease;
}

.main-image:hover {
    transform: scale(1.05);
}

.thumbnails-wrapper {
    padding: 16px;
    border-top: 1px solid #F0E4E8;
}

.thumbnails-container {
    display: flex;
    gap: 12px;
    overflow-x: auto;
    justify-content: center;
    scrollbar-width: thin;
}

.thumbnails-container::-webkit-scrollbar {
    height: 4px;
}

.thumbnails-container::-webkit-scrollbar-track {
    background: #F0E4E8;
    border-radius: 10px;
}

.thumbnails-container::-webkit-scrollbar-thumb {
    background: #D26F8B;
    border-radius: 10px;
}

.thumbnail {
    flex-shrink: 0;
    width: 70px;
    height: 70px;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    border: 2px solid #F0E4E8;
    transition: all 0.3s;
}

.thumbnail:hover {
    border-color: #D26F8B;
    transform: translateY(-2px);
}

.thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Информация о товаре */
.product-info {
    width: 100%;
}

.product-category {
    margin-bottom: 16px;
}

.product-category span {
    font-size: 0.875rem;
    color: #D26F8B;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.product-title {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 16px;
    color: #1A1A1A;
    line-height: 1.2;
}

.product-price-section {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 24px;
    flex-wrap: wrap;
}

.product-price {
    font-size: 2rem;
    font-weight: bold;
    color: #D26F8B;
}

.stock-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.875rem;
}

.in-stock {
    background: rgba(210, 111, 139, 0.1);
    color: #D26F8B;
}

.out-stock {
    background: rgba(229, 57, 53, 0.1);
    color: #E53935;
}

.product-description {
    border-top: 1px solid #F0E4E8;
    padding-top: 24px;
    margin-bottom: 24px;
}

.product-description h3 {
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: 12px;
    color: #1A1A1A;
}

.product-description p {
    color: #666666;
    line-height: 1.6;
}

.product-specs {
    border-top: 1px solid #F0E4E8;
    padding-top: 24px;
    margin-bottom: 24px;
}

.product-specs h3 {
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: 16px;
    color: #1A1A1A;
}

.specs-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.spec-item {
    display: flex;
    justify-content: space-between;
    padding-bottom: 8px;
    border-bottom: 1px solid #F0E4E8;
    flex-wrap: wrap;
    gap: 10px;
}

.spec-label {
    color: #888888;
}

.spec-value {
    color: #4A4A4A;
    text-align: right;
}

.product-actions {
    margin-top: 24px;
}

.add-to-cart-form {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
}

.quantity-selector {
    display: flex;
    align-items: center;
    border: 1px solid #F0E4E8;
    border-radius: 40px;
    flex-shrink: 0;
}

.quantity-btn {
    padding: 12px 16px;
    background: transparent;
    border: none;
    color: #D26F8B;
    font-size: 1.25rem;
    cursor: pointer;
    transition: all 0.3s;
    min-width: 48px;
}

.quantity-btn:hover {
    background: rgba(210, 111, 139, 0.1);
}

.quantity-display {
    width: 60px;
    text-align: center;
    color: #1A1A1A;
    font-size: 1rem;
    font-weight: 500;
}

.add-to-cart-btn {
    flex: 1;
    background: #D26F8B;
    color: #FFFFFF;
    font-weight: 600;
    padding: 12px 24px;
    border-radius: 40px;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
    font-size: 1rem;
}

.add-to-cart-btn:hover {
    background: #E89BB3;
    transform: translateY(-2px);
}

.out-of-stock-message {
    padding: 16px;
    background: rgba(229, 57, 53, 0.1);
    border: 1px solid rgba(229, 57, 53, 0.3);
    border-radius: 12px;
    text-align: center;
}

.out-of-stock-message p {
    color: #E53935;
    margin: 0;
}

/* Адаптивность */
@media (max-width: 1024px) {
    .product-page {
        padding: 40px 0 60px;
    }
    
    .product-grid {
        gap: 32px;
    }
    
    .product-title {
        font-size: 1.75rem;
    }
    
    .product-price {
        font-size: 1.75rem;
    }
}

@media (max-width: 768px) {
    .container {
        padding: 0 20px;
    }
    
    .product-grid {
        grid-template-columns: 1fr;
        gap: 32px;
    }
    
    .product-title {
        font-size: 1.5rem;
    }
    
    .product-price {
        font-size: 1.5rem;
    }
    
    .thumbnail {
        width: 60px;
        height: 60px;
    }
    
    .quantity-btn {
        padding: 10px 14px;
        min-width: 44px;
    }
    
    .add-to-cart-form {
        flex-direction: column;
    }
    
    .quantity-selector {
        width: 100%;
        justify-content: center;
    }
    
    .spec-item {
        flex-direction: column;
        gap: 5px;
    }
    
    .spec-value {
        text-align: left;
    }
}

@media (max-width: 480px) {
    .product-page {
        padding: 30px 0 40px;
    }
    
    .container {
        padding: 0 15px;
    }
    
    .product-title {
        font-size: 1.25rem;
    }
    
    .product-price-section {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .thumbnail {
        width: 50px;
        height: 50px;
    }
    
    .thumbnails-wrapper {
        padding: 12px;
    }
    
    .thumbnails-container {
        gap: 8px;
    }
    
    .product-description h3,
    .product-specs h3 {
        font-size: 1rem;
    }
    
    .product-description p,
    .spec-label,
    .spec-value {
        font-size: 0.875rem;
    }
}

/* Для очень больших экранов */
@media (min-width: 1600px) {
    .container {
        max-width: 1600px;
    }
    
    .product-grid {
        gap: 64px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Логика изменения количества
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
    
    // Слайдер для переключения изображений
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.getElementById('mainImage');
    
    if (thumbnails.length > 0 && mainImage) {
        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                const newImageSrc = this.getAttribute('data-image');
                if (newImageSrc) {
                    mainImage.src = newImageSrc;
                    
                    // Обновляем активную рамку
                    thumbnails.forEach(t => {
                        t.style.borderColor = '#F0E4E8';
                    });
                    this.style.borderColor = '#D26F8B';
                }
            });
        });
    }
    
    // Клик по главному изображению для открытия в полном размере
    if (mainImage) {
        mainImage.addEventListener('click', function() {
            window.open(this.src, '_blank');
        });
    }
});
</script>
@endsection