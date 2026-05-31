@extends('layouts.app')

@section('title', 'Цветы премиум-класса')

@section('content')
    <!-- Hero секция (без отступа от шапки) -->
<!-- Hero секция (без отступа от шапки, с идеальным центрированием) -->
<section style="min-height: calc(100vh - 80px); display: flex; align-items: center; justify-content: center; background-image: url('{{ asset('img/Баннер.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; margin-top: -90px; padding-top: 90px;">
    <div class="container" style="width: 100%;">
        <div style="max-width: 800px; margin: 0 auto; background: rgba(0, 0, 0, 0.55); border-radius: 24px; padding: 60px 40px; backdrop-filter: blur(4px); text-align: center;">
            <h1 style="font-size: clamp(2rem, 6vw, 5rem); font-weight: 800; margin-bottom: 24px; color: #FFFFFF; line-height: 1.2;">
                Цветы <span style="color: #FFB6C1; position: relative; display: inline-block;">премиум-класса
                    <span style="position: absolute; bottom: 8px; left: 0; right: 0; height: 12px; background: rgba(255, 182, 193, 0.3); border-radius: 10px; z-index: -1;"></span>
                </span>
            </h1>
            <p style="font-size: clamp(1rem, 4vw, 1.3rem); margin-bottom: 40px; max-width: 600px; margin-left: auto; margin-right: auto; color: #F5F5F5; line-height: 1.6; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
                Удовольствие от хорошего качества длится дольше, чем радость от низкой цены.
            </p>
            <div>
                <a href="{{ route('catalog.index') }}" class="btn-primary" style="display: inline-block; font-size: 1.1rem; padding: 14px 40px; background: #D26F8B; color: white; text-decoration: none; border-radius: 50px; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(210, 111, 139, 0.4);">
                    Смотреть букеты →
                </a>
            </div>
        </div>
    </div>
</section>

    <!-- Преимущества -->
    <section style="padding: 80px 0; background: #FFFFFF;">
        <div class="container">
            <div style="text-align: center; margin-bottom: 56px;">
                <span style="color: #D26F8B; font-weight: 600; text-transform: uppercase; letter-spacing: 2px; font-size: 0.8rem;">Почему мы</span>
                <h2 style="font-size: clamp(1.6rem, 5vw, 2.2rem); font-weight: 700; margin-top: 12px; color: #1A1A1A;">
                    Family Flowers — <span style="color: #D26F8B;">это доверие</span>
                </h2>
                <div style="width: 60px; height: 3px; background: #D26F8B; margin: 20px auto 0;"></div>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 32px;">
                <div style="text-align: center; padding: 32px 24px; background: #FAF8F9; border-radius: 20px; transition: all 0.3s ease; border: 1px solid #F0E4E8;">
                    <div style="width: 70px; height: 70px; background: #D26F8B; border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
                        <svg style="width: 32px; height: 32px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 12px; color: #1A1A1A;">Премиум качество</h3>
                    <p style="color: #666666; line-height: 1.6;">Только лучшие сорта от ведущих плантаций мира</p>
                </div>
                
                <div style="text-align: center; padding: 32px 24px; background: #FAF8F9; border-radius: 20px; transition: all 0.3s ease; border: 1px solid #F0E4E8;">
                    <div style="width: 70px; height: 70px; background: #D26F8B; border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
                        <svg style="width: 32px; height: 32px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 12px; color: #1A1A1A;">Свежесть 24/7</h3>
                    <p style="color: #666666; line-height: 1.6;">Цветы срезаны в день доставки</p>
                </div>
                
                <div style="text-align: center; padding: 32px 24px; background: #FAF8F9; border-radius: 20px; transition: all 0.3s ease; border: 1px solid #F0E4E8;">
                    <div style="width: 70px; height: 70px; background: #D26F8B; border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
                        <svg style="width: 32px; height: 32px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 12px; color: #1A1A1A;">Быстрая доставка</h3>
                    <p style="color: #666666; line-height: 1.6;">Доставка по городу за 2-3 часа</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Популярные букеты -->
    <section style="padding: 80px 0; background: #F4EBF3;">
        <div class="container">
            <div style="text-align: center; margin-bottom: 56px;">
                <span style="color: #D26F8B; font-weight: 600; text-transform: uppercase; letter-spacing: 2px; font-size: 0.8rem;">Коллекция</span>
                <h2 style="font-size: clamp(1.6rem, 5vw, 2.2rem); font-weight: 700; margin-top: 12px; color: #1A1A1A;">
                    Популярные <span style="color: #D26F8B;">букеты</span>
                </h2>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 32px;">
                @foreach($popularFlowers as $flower)
                <div class="product-card" style="background: #FFFFFF; border-radius: 20px; overflow: hidden; transition: all 0.3s ease; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06); border: 1px solid #F0E4E8;">
                    <div style="height: 280px; overflow: hidden; background: #120B0E; position: relative;">
                        <img src="{{ App\Helpers\ImageHelper::getFlowerImage($flower->image_path) }}" 
                             alt="{{ $flower->name }}"
                             style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;">
                        <span style="position: absolute; top: 16px; right: 16px; background: #D26F8B; color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 600;">Хит</span>
                    </div>
                    <div style="padding: 24px;">
                        <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 8px; color: #1A1A1A; transition: color 0.3s;">{{ $flower->name }}</h3>
                        <p style="color: #777777; font-size: 0.85rem; margin-bottom: 20px; line-height: 1.5;">{{ Str::limit($flower->description, 65) }}</p>
                        <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #F0E4E8; padding-top: 16px; flex-wrap: wrap; gap: 12px;">
                            <span style="font-size: 1.6rem; font-weight: 800; color: #D26F8B;">{{ number_format($flower->price, 0, ',', ' ') }} ₽</span>
                            <form action="{{ route('cart.add', $flower) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" style="background: #D26F8B; color: white; border: none; padding: 10px 24px; border-radius: 30px; font-weight: 600; font-size: 0.85rem; cursor: pointer; transition: all 0.3s; display: flex; align-items: center; gap: 8px;">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6M17 13l1.5 6M9 21h6M12 18v3"/>
                                    </svg>
                                    В корзину
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div style="text-align: center; margin-top: 56px;">
                <a href="{{ route('catalog.index') }}" style="display: inline-flex; align-items: center; gap: 12px; background: transparent; border: 2px solid #D26F8B; color: #D26F8B; padding: 12px 32px; border-radius: 40px; font-weight: 600; text-decoration: none; transition: all 0.3s;">
                    Весь каталог
                    <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endsection

<style>
    .container {
        max-width: 1400px;
        width: 100%;
        margin: 0 auto;
        padding: 0 40px;
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 0 20px;
        }
    }
    
    @media (max-width: 480px) {
        .container {
            padding: 0 15px;
        }
    }
    
    .btn-primary {
        background: #D26F8B;
        color: #FFFFFF;
        padding: 14px 36px;
        border-radius: 40px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 4px 12px rgba(210, 111, 139, 0.3);
    }
    
    .btn-primary:hover {
        background: #E89BB3;
        transform: translateY(-2px);
        color: #FFFFFF;
        box-shadow: 0 6px 20px rgba(210, 111, 139, 0.4);
    }
    
    .product-card {
        transition: all 0.3s ease;
    }
    
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 35px rgba(210, 111, 139, 0.12) !important;
        border-color: #D26F8B !important;
    }
    
    .product-card:hover h3 {
        color: #D26F8B;
    }
    
    .product-card:hover img {
        transform: scale(1.08);
    }
    
    button[type="submit"]:hover {
        background: #E89BB3 !important;
        transform: translateY(-2px);
    }
    
    a[href="{{ route('catalog.index') }}"]:hover {
        background: #D26F8B !important;
        color: white !important;
    }
    
    body {
        background: #FAF8F9;
        color: #1A1A1A;
        font-family: system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
    }
    
    footer {
        background: #1A1A1A;
        color: #AAAAAA;
        padding: 48px 0;
        margin-top: 0;
    }
</style>