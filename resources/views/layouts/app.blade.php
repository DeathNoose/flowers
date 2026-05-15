<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FAMILE FLOWERS - @yield('title', 'Цветы премиум-класса')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: #FAF8F9;
            color: #1A1A1A;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }
        
        /* Шапка */
        .site-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            background: #FFFFFF;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid #F0E4E8;
        }
        
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
        
        /* Логотип */
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        
        .logo-icon {
            width: 40px;
            height: 40px;
            background: #D26F8B;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .logo-icon svg {
            width: 24px;
            height: 24px;
            color: white;
        }
        
        .logo-text {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1A1A1A;
            letter-spacing: -0.5px;
        }
        
        .logo-text span {
            color: #D26F8B;
        }
        
        /* Кнопки */
        .btn-primary {
            background: #D26F8B;
            color: #FFFFFF;
            padding: 12px 32px;
            border-radius: 40px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
            border: none;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(210, 111, 139, 0.25);
        }
        
        .btn-primary:hover {
            background: #E89BB3;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(210, 111, 139, 0.35);
        }
        
        .btn-outline {
            border: 2px solid #D26F8B;
            color: #D26F8B;
            background: transparent;
            padding: 8px 20px;
            border-radius: 40px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
            cursor: pointer;
            text-decoration: none;
        }
        
        .btn-outline:hover {
            background: #D26F8B;
            color: #FFFFFF;
        }
        
        /* Навигация */
/* Стили для меню */
/* Навигация - ИСПРАВЛЕННАЯ ВЕРСИЯ */
.nav-menu {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.nav-menu a {
    color: #4A4A4A;
    text-decoration: none;
    transition: color 0.3s ease;
    font-weight: 500;
    background: transparent !important;
    padding: 0 !important;
    border-radius: 0 !important;
    box-shadow: none !important;
}

.nav-menu a:hover {
    color: #D26F8B !important;
    background: transparent !important;
    transform: none !important;
    box-shadow: none !important;
}
        
        /* Карточки товаров */
        .product-card {
            background: #FFFFFF;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid #F0E4E8;
        }
        
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(210, 111, 139, 0.12);
            border-color: #D26F8B;
        }
        
        .product-card:hover h3 {
            color: #D26F8B;
        }
        
        .product-card:hover img {
            transform: scale(1.05);
        }
        
        .product-card img {
            transition: transform 0.5s ease;
        }
        
        /* Скроллбар */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #F0E4E8;
        }
        ::-webkit-scrollbar-thumb {
            background: #D26F8B;
            border-radius: 10px;
        }
        
        .main-content {
            padding-top: 90px;
        }
        
        /* Выпадающее меню пользователя */
        .user-menu {
            position: relative;
        }
        
        .user-trigger {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            padding: 8px 16px;
            border-radius: 40px;
            background: #F5F0F2;
            transition: all 0.3s ease;
            color: #1A1A1A;
            font-weight: 500;
        }
        
        .user-trigger:hover {
            background: #E89BB3;
            color: white;
        }
        
        .user-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            width: 280px;
            background: #FFFFFF;
            border-radius: 16px;
            border: 1px solid #F0E4E8;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.25s ease;
            z-index: 1000;
        }
        
        .user-menu:hover .user-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-header {
            padding: 16px;
            border-bottom: 1px solid #F0E4E8;
        }
        
        .dropdown-name {
            font-weight: 700;
            color: #1A1A1A;
            margin-bottom: 4px;
        }
        
        .dropdown-email {
            font-size: 0.75rem;
            color: #888888;
        }
        
        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #4A4A4A;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 0.875rem;
        }
        
        .dropdown-item:hover {
            background: rgba(210, 111, 139, 0.08);
            color: #D26F8B;
        }
        
        .dropdown-divider {
            height: 1px;
            background: #F0E4E8;
            margin: 8px 0;
        }
        
        .logout-btn {
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            cursor: pointer;
            color: #E53935;
        }
        
        .logout-btn:hover {
            background: rgba(229, 57, 53, 0.08);
            color: #E53935;
        }
        
        /* Формы */
        input:focus, textarea:focus, select:focus {
            border-color: #D26F8B !important;
            outline: none;
            box-shadow: 0 0 0 3px rgba(210, 111, 139, 0.15);
        }
        
        /* Пагинация */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            flex-wrap: wrap;
        }
        
        .pagination a, .pagination span {
            padding: 8px 16px;
            background: #FFFFFF;
            border: 1px solid #F0E4E8;
            border-radius: 8px;
            color: #4A4A4A;
            text-decoration: none;
            transition: all 0.3s;
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
        
        /* Корзина */
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -12px;
            background: #D26F8B;
            color: white;
            font-size: 0.7rem;
            font-weight: 700;
            border-radius: 20px;
            min-width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 5px;
        }
        
        /* Адаптивность */
        @media (max-width: 768px) {
            .nav-menu {
                gap: 1rem;
            }
            .user-trigger span {
                display: none;
            }
            .user-trigger {
                padding: 8px 12px;
            }
            .logo-text {
                font-size: 1.2rem;
            }
        }
        
        @media (max-width: 1024px) {
            footer [style*="grid-template-columns: repeat(4, 1fr)"] {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 32px !important;
            }
        }
        
        @media (max-width: 640px) {
            footer [style*="grid-template-columns: repeat(4, 1fr)"] {
                grid-template-columns: 1fr !important;
                text-align: center !important;
            }
        }
        
        /* Утилиты */
        .flex { display: flex; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .gap-2 { gap: 8px; }
        .gap-3 { gap: 12px; }
        .gap-4 { gap: 16px; }
        .relative { position: relative; }
        .text-sm { font-size: 0.875rem; }
        
        /* Цвета */
        .text-white { color: #FFFFFF; }
        .bg-rose { background: #D26F8B; }
        
        /* Анимации */
        button, a { transition: all 0.2s ease; }
    </style>
</head>
<body>
    <!-- Шапка -->
    <header class="site-header">
        <div class="container">
            <div class="flex justify-between items-center" style="height: 80px;">
                <a href="{{ route('home') }}" class="flex items-center gap-3" style="text-decoration: none;">
                    <img src="{{ asset('img/logo.png') }}" alt="FAMILE FLOWERS" 
                        style="height: 60px; width: auto;">
                    <span style="font-size: 1.8rem; font-weight: 800; color: #D26F8B; letter-spacing: -0.5px;">
                        FAMILE FLOWERS
                    </span>
                </a>
                <nav class="nav-menu">
                    <a href="{{ route('catalog.index') }}" class="nav-link">Каталог</a>
                    <a href="{{ route('delivery') }}" class="nav-link">Доставка</a>
                    <a href="{{ route('contacts') }}" class="nav-link">Контакты</a>
                </nav>
                
                <div class="flex items-center gap-4">
                    <a href="{{ route('cart.index') }}" class="relative nav-link" style="display: flex; align-items: center;">
                        <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        @php
                            $cart = new \App\Models\Cart();
                            $cartCount = $cart->getCount();
                        @endphp
                        @if($cartCount > 0)
                            <span class="cart-badge">{{ $cartCount }}</span>
                        @endif
                    </a>
                    
                    @auth
                        <div class="user-menu">
                            <div class="user-trigger">
                                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>{{ Auth::user()->name }}</span>
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                            <div class="user-dropdown">
                                <div class="dropdown-header">
                                    <div class="dropdown-name">{{ Auth::user()->name }}</div>
                                    <div class="dropdown-email">{{ Auth::user()->email }}</div>
                                </div>
                                
                                <a href="{{ route('profile.index') }}" class="dropdown-item">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Личный кабинет
                                </a>
                                
                                @if(Auth::user()->isAdmin())
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Админ-панель
                                    </a>
                                    <a href="{{ route('admin.products.index') }}" class="dropdown-item">
                                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                        Товары
                                    </a>
                                    <a href="{{ route('admin.categories.index') }}" class="dropdown-item">
                                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
                                        </svg>
                                        Категории
                                    </a>
                                    <a href="{{ route('admin.orders.index') }}" class="dropdown-item">
                                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                        Заказы
                                    </a>
                                    <a href="{{ route('admin.users.index') }}" class="dropdown-item">
                                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        Пользователи
                                    </a>
                                @endif
                                
                                <div class="dropdown-divider"></div>
                                
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item logout-btn">
                                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Выйти
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-3">
                            <a href="{{ route('login') }}" class="nav-link">Вход</a>
                            <a href="{{ route('register') }}" class="btn-primary" style="padding: 8px 20px; font-size: 0.875rem;">Регистрация</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Основной контент -->
    <div class="main-content">
        @if(session('success'))
            <div class="container" style="margin-top: 20px;">
                <div style="background: rgba(210, 111, 139, 0.1); border: 1px solid #D26F8B; border-radius: 12px; padding: 16px; text-align: center;">
                    <p style="color: #D26F8B; font-weight: 500;">✓ {{ session('success') }}</p>
                </div>
            </div>
        @endif
        
        @if(session('error'))
            <div class="container" style="margin-top: 20px;">
                <div style="background: rgba(229, 57, 53, 0.1); border: 1px solid #E53935; border-radius: 12px; padding: 16px; text-align: center;">
                    <p style="color: #E53935; font-weight: 500;">⚠ {{ session('error') }}</p>
                </div>
            </div>
        @endif
        
        @yield('content')
    </div>

    <!-- Футер -->
    <footer style="background: #1A1A1A; margin-top: 80px; padding: 60px 0 40px;">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 40px; margin-bottom: 48px;">
                <div>
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                        <div>
                        </div>
                        <span style="font-size: 1.3rem; font-weight: 700; color: #FFFFFF;">FAMILE FLOWERS</span>
                    </div>
                    <p style="color: #AAAAAA; font-size: 0.875rem; line-height: 1.6;">
                        Удовольствие от хорошего качества длится дольше, чем радость от низкой цены.
                    </p>
                </div>
                
                <div>
                    <h4 style="font-weight: 700; margin-bottom: 20px; color: #FFFFFF;">Навигация</h4>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 10px;"><a href="{{ route('catalog.index') }}" style="color: #AAAAAA; text-decoration: none; transition: color 0.3s; font-size: 0.875rem;">Каталог</a></li>
                        <li style="margin-bottom: 10px;"><a href="{{ route('delivery') }}" style="color: #AAAAAA; text-decoration: none; transition: color 0.3s; font-size: 0.875rem;">Доставка</a></li>
                        <li style="margin-bottom: 10px;"><a href="{{ route('contacts') }}" style="color: #AAAAAA; text-decoration: none; transition: color 0.3s; font-size: 0.875rem;">Контакты</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 style="font-weight: 700; margin-bottom: 20px; color: #FFFFFF;">Контакты</h4>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 10px;">
                            <a href="tel:+79630101012" style="color: #AAAAAA; text-decoration: none; transition: color 0.3s; font-size: 0.875rem;">+7 (963) 010-10-12</a>
                        </li>
                        <li style="margin-bottom: 10px;">
                            <a href="mailto:family.flowers@mail.ru" style="color: #AAAAAA; text-decoration: none; transition: color 0.3s; font-size: 0.875rem;">family.flowers@mail.ru</a>
                        </li>
                        <li><span style="color: #AAAAAA; font-size: 0.875rem;">Ежедневно: 8:00 – 22:00</span></li>
                    </ul>
                </div>
                
                <div>
                    <h4 style="font-weight: 700; margin-bottom: 20px; color: #FFFFFF;">Мы в соцсетях</h4>
                    <a href="https://vk.com/family.flowers.premium" target="_blank" 
                       style="display: inline-flex; align-items: center; justify-content: center; width: 44px; height: 44px; background: rgba(255,255,255,0.05); border-radius: 12px; transition: all 0.3s;">
                        <i class="fab fa-vk" style="color: #AAAAAA; font-size: 1.25rem;"></i>
                    </a>
                    <p style="color: #666666; font-size: 0.7rem; margin-top: 16px;">Подписывайтесь!</p>
                </div>
            </div>
            
            <div style="margin-top: 32px; padding-top: 32px; border-top: 1px solid rgba(255,255,255,0.08);">
                <div style="text-align: center; color: #666666; font-size: 0.75rem;">
                    <p>&copy; 2026 FAMILE FLOWERS. Цветы с любовью.</p>
                </div>
            </div>
        </div>
    </footer>
    @stack('scripts')
</body>
</html>