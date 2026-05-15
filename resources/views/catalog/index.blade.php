@extends('layouts.app')

@section('title', 'Каталог цветов')

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    <div style="text-align: center; margin-bottom: 60px;">
        <h1 style="font-size: 3rem; font-weight: bold; margin-bottom: 16px; color: #1A1A1A;">
            Наш <span style="color: #D26F8B;">каталог</span>
        </h1>
        <p style="color: #888888; font-size: 1.125rem; max-width: 600px; margin: 0 auto;">
            Эксклюзивные композиции, созданные для ценителей качества и стиля
        </p>
    </div>
    
    <!-- Фильтры -->
    <div style="background: #FFFFFF; border-radius: 20px; padding: 24px; margin-bottom: 40px; border: 1px solid #F0E4E8; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
        <form method="GET" action="{{ route('catalog.index') }}" id="filter-form">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; align-items: end;">
                <!-- Фильтр по категории -->
                <div>
                    <label for="category" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #4A4A4A;">Категория</label>
                    <div style="position: relative;">
                        <select name="category" id="category" style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 10px 32px 10px 14px; color: #1A1A1A; transition: all 0.3s; appearance: none; -webkit-appearance: none; cursor: pointer;">
                            <option value="">Все категории</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <svg style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; pointer-events: none; color: #D26F8B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
                
                <!-- Фильтр по цене (от) -->
                <div>
                    <label for="price_min" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #4A4A4A;">Цена от (₽)</label>
                    <input type="number" name="price_min" id="price_min" value="{{ request('price_min') }}" placeholder="0" min="0" step="100"
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 10px 14px; color: #1A1A1A;">
                </div>
                
                <!-- Фильтр по цене (до) -->
                <div>
                    <label for="price_max" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #4A4A4A;">Цена до (₽)</label>
                    <input type="number" name="price_max" id="price_max" value="{{ request('price_max') }}" placeholder="Любая" min="0" step="100"
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 10px 14px; color: #1A1A1A;">
                </div>
                
                <!-- Фильтр по наличию -->
                <div>
                    <label for="in_stock" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #4A4A4A;">Наличие</label>
                    <div style="position: relative;">
                        <select name="in_stock" id="in_stock" style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 10px 32px 10px 14px; color: #1A1A1A; transition: all 0.3s; appearance: none; -webkit-appearance: none; cursor: pointer;">
                            <option value="">Все</option>
                            <option value="1" {{ request('in_stock') == '1' ? 'selected' : '' }}>В наличии</option>
                            <option value="0" {{ request('in_stock') == '0' ? 'selected' : '' }}>Нет в наличии</option>
                        </select>
                        <svg style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; pointer-events: none; color: #D26F8B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
                
                <!-- Кнопки -->
                <div style="display: flex; gap: 12px;">
                    <button type="submit" style="background: #D26F8B; color: #FFFFFF; font-weight: 600; padding: 10px 24px; border-radius: 40px; border: none; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(210, 111, 139, 0.25);">
                        Применить
                    </button>
                    <a href="{{ route('catalog.index') }}" style="background: #FAF8F9; border: 1px solid #F0E4E8; color: #666666; font-weight: 500; padding: 10px 24px; border-radius: 40px; text-decoration: none; transition: all 0.3s;">
                        Сбросить
                    </a>
                </div>
            </div>
        </form>
        
        <!-- Активные фильтры -->
        @if(request('category') || request('price_min') || request('price_max') || request('in_stock'))
            <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 20px; padding-top: 20px; border-top: 1px solid #F0E4E8;">
                <span style="font-size: 0.75rem; color: #888888;">Активные фильтры:</span>
                @if(request('category'))
                    @php
                        $selectedCategory = $categories->find(request('category'));
                    @endphp
                    <span style="background: rgba(210, 111, 139, 0.1); color: #D26F8B; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem;">
                        Категория: {{ $selectedCategory ? $selectedCategory->name : request('category') }}
                        <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" style="color: #D26F8B; margin-left: 6px; text-decoration: none;">✕</a>
                    </span>
                @endif
                @if(request('price_min'))
                    <span style="background: rgba(210, 111, 139, 0.1); color: #D26F8B; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem;">
                        Цена от: {{ number_format(request('price_min'), 0, ',', ' ') }} ₽
                        <a href="{{ request()->fullUrlWithQuery(['price_min' => null]) }}" style="color: #D26F8B; margin-left: 6px; text-decoration: none;">✕</a>
                    </span>
                @endif
                @if(request('price_max'))
                    <span style="background: rgba(210, 111, 139, 0.1); color: #D26F8B; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem;">
                        Цена до: {{ number_format(request('price_max'), 0, ',', ' ') }} ₽
                        <a href="{{ request()->fullUrlWithQuery(['price_max' => null]) }}" style="color: #D26F8B; margin-left: 6px; text-decoration: none;">✕</a>
                    </span>
                @endif
                @if(request('in_stock') === '1')
                    <span style="background: rgba(210, 111, 139, 0.1); color: #D26F8B; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem;">
                        Только в наличии
                        <a href="{{ request()->fullUrlWithQuery(['in_stock' => null]) }}" style="color: #D26F8B; margin-left: 6px; text-decoration: none;">✕</a>
                    </span>
                @endif
                @if(request('in_stock') === '0')
                    <span style="background: rgba(210, 111, 139, 0.1); color: #D26F8B; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem;">
                        Товаров нет в наличии
                        <a href="{{ request()->fullUrlWithQuery(['in_stock' => null]) }}" style="color: #D26F8B; margin-left: 6px; text-decoration: none;">✕</a>
                    </span>
                @endif
            </div>
        @endif
    </div>
    
    <!-- Результаты -->
    @if($flowers->count() > 0)
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px;">
            @foreach($flowers as $flower)
            <div class="product-card" style="background: #FFFFFF; border-radius: 20px; overflow: hidden; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
                <a href="{{ route('catalog.show', $flower) }}" style="display: block;">
                    <div style="height: 260px; overflow: hidden; position: relative;">
                        <img src="{{ \App\Helpers\ImageHelper::getFlowerImage($flower->image_path) }}" 
                             alt="{{ $flower->name }}"
                             style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;"
                             onerror="this.src='{{ asset('img/placeholder.jpg') }}'">
                        @if(!$flower->in_stock)
                            <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.7); display: flex; align-items: center; justify-content: center;">
                                <span style="padding: 8px 16px; background: rgba(229, 57, 53, 0.8); color: white; border-radius: 8px; font-weight: 600;">Нет в наличии</span>
                            </div>
                        @endif
                    </div>
                </a>
                <div style="padding: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                        <span style="font-size: 12px; color: #D26F8B; text-transform: uppercase; letter-spacing: 0.5px;">{{ $flower->category->name }}</span>
                        @if($flower->in_stock)
                            <span style="font-size: 12px; color: #4A7C59;">✓ В наличии</span>
                        @endif
                    </div>
                    <a href="{{ route('catalog.show', $flower) }}" style="text-decoration: none;">
                        <h3 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 8px; color: #1A1A1A; transition: color 0.3s;">{{ $flower->name }}</h3>
                    </a>
                    <p style="color: #666666; font-size: 0.875rem; margin-bottom: 16px; line-height: 1.4;">
                        {{ Str::limit($flower->description, 70) }}
                    </p>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 1.25rem; font-weight: bold; color: #D26F8B;">{{ number_format($flower->price, 0, ',', ' ') }} ₽</span>
                        @if($flower->in_stock)
                            <form action="{{ route('cart.add', $flower) }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="cart-button" style="border: 2px solid #D26F8B; color: #D26F8B; background: transparent; padding: 6px 16px; border-radius: 30px; font-weight: 500; font-size: 0.875rem; cursor: pointer; transition: all 0.3s;">
                                    В корзину
                                </button>
                            </form>
                        @else
                            <button disabled style="border: 1px solid #E8D0D8; color: #AAAAAA; background: transparent; padding: 6px 16px; border-radius: 30px; font-size: 0.875rem; cursor: not-allowed;">
                                Нет в наличии
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Пагинация -->
        <div style="margin-top: 60px;">
            @if ($flowers->hasPages())
                <div style="display: flex; justify-content: center; align-items: center; gap: 8px; flex-wrap: wrap;">
                    {{-- Previous Page Link --}}
                    @if ($flowers->onFirstPage())
                        <span style="padding: 8px 16px; background: #F5F0F2; border: 1px solid #F0E4E8; border-radius: 8px; color: #AAAAAA; cursor: not-allowed;">
                            ← Назад
                        </span>
                    @else
                        <a href="{{ $flowers->previousPageUrl() }}" style="padding: 8px 16px; background: #FFFFFF; border: 1px solid #F0E4E8; border-radius: 8px; color: #D26F8B; text-decoration: none; transition: all 0.3s;">
                            ← Назад
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($flowers->links()->elements as $element)
                        @if (is_string($element))
                            <span style="padding: 8px 12px; color: #AAAAAA;">{{ $element }}</span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $flowers->currentPage())
                                    <span style="padding: 8px 16px; background: #D26F8B; color: #FFFFFF; border-radius: 8px; font-weight: 600;">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" style="padding: 8px 16px; background: #FFFFFF; border: 1px solid #F0E4E8; border-radius: 8px; color: #4A4A4A; text-decoration: none; transition: all 0.3s;">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($flowers->hasMorePages())
                        <a href="{{ $flowers->nextPageUrl() }}" style="padding: 8px 16px; background: #FFFFFF; border: 1px solid #F0E4E8; border-radius: 8px; color: #D26F8B; text-decoration: none; transition: all 0.3s;">
                            Вперед →
                        </a>
                    @else
                        <span style="padding: 8px 16px; background: #F5F0F2; border: 1px solid #F0E4E8; border-radius: 8px; color: #AAAAAA; cursor: not-allowed;">
                            Вперед →
                        </span>
                    @endif
                </div>
            @endif
        </div>
    @else
        <!-- Нет результатов -->
        <div style="text-align: center; padding: 80px 20px; background: #FFFFFF; border-radius: 24px; border: 1px solid #F0E4E8;">
            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#D26F8B" stroke-width="1" style="margin-bottom: 20px; opacity: 0.5;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <h3 style="font-size: 1.5rem; color: #1A1A1A; margin-bottom: 8px;">Ничего не найдено</h3>
            <p style="color: #AAAAAA; margin-bottom: 24px;">Попробуйте изменить параметры фильтрации</p>
            <a href="{{ route('catalog.index') }}" style="background: #D26F8B; color: #FFFFFF; padding: 10px 24px; border-radius: 40px; text-decoration: none; display: inline-block;">
                Сбросить фильтры
            </a>
        </div>
    @endif
</div>

<style>
    .container {
        max-width: 1400px;
        width: 100%;
        margin: 0 auto;
        padding: 0 40px;
    }
    
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(210, 111, 139, 0.12) !important;
        border-color: #D26F8B !important;
    }
    
    .product-card:hover h3 {
        color: #D26F8B;
    }
    
    .product-card:hover img {
        transform: scale(1.05);
    }
    
    .cart-button:hover {
        background: #D26F8B;
        color: #FFFFFF;
        transform: translateY(-2px);
    }
    
    select:focus, input:focus {
        outline: none;
        border-color: #D26F8B !important;
        box-shadow: 0 0 0 3px rgba(210, 111, 139, 0.15);
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 0 20px;
        }
        
        h1 {
            font-size: 2rem !important;
        }
        
        .product-card {
            margin: 0 0 20px 0;
        }
    }
    
    @media (max-width: 640px) {
        .filter-form-grid {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endsection