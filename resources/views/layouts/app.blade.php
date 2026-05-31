<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Family Flowers - @yield('title', 'Цветы премиум-класса')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .main-content {
            flex: 1;
            padding-top: 90px;
        }
        
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
        
        .header-container {
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            flex-shrink: 0;
        }
        
        .logo-img {
            height: 55px;
            width: auto;
        }
        
        .logo-text {
            font-size: 1.5rem;
            font-weight: 800;
            color: #D26F8B;
            letter-spacing: -0.5px;
        }
        
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
            white-space: nowrap;
        }
        
        .nav-menu a:hover {
            color: #D26F8B;
        }
        
        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-shrink: 0;
        }
        
        .btn-primary {
            background: #D26F8B;
            color: #FFFFFF;
            padding: 10px 24px;
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
        
        .login-link {
            color: #4A4A4A;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
            padding: 8px 0;
            display: inline-block;
        }
        
        .login-link:hover {
            color: #D26F8B;
        }
        
        .cart-link {
            position: relative;
            display: flex;
            align-items: center;
            color: #4A4A4A;
            text-decoration: none;
        }
        
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
            border-radius: 20px;
            border: 1px solid #F0E4E8;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.25s ease;
            z-index: 1000;
            padding: 8px;
        }
        
        .user-menu:hover .user-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-header {
            padding: 12px;
            border-bottom: 1px solid #F0E4E8;
            margin-bottom: 4px;
        }
        
        .dropdown-name {
            font-weight: 700;
            color: #1A1A1A;
            margin-bottom: 4px;
        }
        
        .dropdown-email {
            font-size: 0.75rem;
            color: #888888;
            word-break: break-all;
        }
        
        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            color: #4A4A4A;
            text-decoration: none;
            font-size: 0.875rem;
            background: transparent;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            border-radius: 12px;
            transition: all 0.2s ease;
            margin: 2px 0;
        }
        
        .dropdown-item:hover {
            background: rgba(210, 111, 139, 0.1);
            color: #D26F8B;
        }
        
        .logout-btn {
            color: #E53935;
            border-radius: 12px;
        }
        
        .logout-btn:hover {
            background: rgba(229, 57, 53, 0.1);
            color: #E53935;
        }
        
        .dropdown-item:focus,
        .dropdown-item:active,
        .logout-btn:focus,
        .logout-btn:active {
            outline: none;
            box-shadow: none;
        }
        
        .dropdown-divider {
            height: 1px;
            background: #F0E4E8;
            margin: 8px 0;
        }
        
        .toast-notification {
            position: fixed;
            top: 100px;
            right: 20px;
            z-index: 9999;
            animation: slideInRight 0.3s ease;
        }
        
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .toast-notification.hide {
            animation: slideOutRight 0.3s ease forwards;
        }
        
        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
        
        .toast-content {
            min-width: 320px;
            max-width: 450px;
            background: #FFFFFF;
            border-radius: 16px;
            padding: 16px 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            border-left: 4px solid;
        }
        
        .toast-success {
            border-left-color: #D26F8B;
            background: linear-gradient(135deg, #FFFFFF 0%, #FFF8F9 100%);
        }
        
        .toast-success .toast-icon {
            color: #D26F8B;
        }
        
        .toast-error {
            border-left-color: #E53935;
            background: linear-gradient(135deg, #FFFFFF 0%, #FFF5F5 100%);
        }
        
        .toast-error .toast-icon {
            color: #E53935;
        }
        
        .toast-icon {
            font-size: 1.5rem;
            flex-shrink: 0;
        }
        
        .toast-message {
            flex: 1;
            color: #1A1A1A;
            font-size: 0.875rem;
            line-height: 1.4;
            font-weight: 500;
        }
        
        .toast-close {
            background: rgba(210, 111, 139, 0.1);
            border: none;
            cursor: pointer;
            color: #D26F8B;
            font-size: 1.25rem;
            padding: 4px 8px;
            border-radius: 8px;
            transition: all 0.2s;
            line-height: 1;
        }
        
        .toast-close:hover {
            background: #D26F8B;
            color: white;
            transform: scale(1.05);
        }
        
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
        
        footer {
            background: #1A1A1A;
            margin-top: 80px;
            padding: 60px 0 40px;
        }
        
        /* Стили для иконок соцсетей */
        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            background: rgba(255,255,255,0.05);
            border-radius: 12px;
            transition: all 0.3s ease;
            margin-right: 12px;
            text-decoration: none;
        }
        
        .social-icon:hover {
            background: #D26F8B;
            transform: translateY(-3px);
        }
        
        .social-icon:hover i,
        .social-icon:hover svg {
            color: white !important;
        }
        
        .social-icon i,
        .social-icon svg {
            transition: all 0.3s ease;
        }
        
        /* Адаптивность */
        @media (max-width: 1200px) {
            .container {
                padding: 0 30px;
            }
        }
        
        @media (max-width: 1024px) {
            .nav-menu {
                gap: 1.5rem;
            }
            
            .logo-text {
                font-size: 1.2rem;
            }
            
            .logo-img {
                height: 45px;
            }
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 0 20px;
            }
            
            .header-container {
                height: 70px;
            }
            
            .main-content {
                padding-top: 70px;
            }
            
            .logo-text {
                display: none;
            }
            
            .nav-menu {
                gap: 1rem;
            }
            
            .nav-menu a {
                font-size: 0.875rem;
            }
            
            .user-trigger span {
                display: none;
            }
            
            .user-trigger {
                padding: 8px 12px;
            }
            
            .header-right {
                gap: 12px;
            }
            
            .btn-primary {
                padding: 6px 16px;
                font-size: 0.75rem;
            }
            
            .toast-notification {
                left: 20px;
                right: 20px;
                top: 80px;
            }
            
            .toast-content {
                min-width: auto;
                max-width: none;
            }
        }
        
        @media (max-width: 640px) {
            .nav-menu {
                gap: 0.75rem;
            }
            
            .nav-menu a {
                font-size: 0.75rem;
            }
            
            .user-dropdown {
                position: fixed;
                top: 70px;
                right: 10px;
                left: 10px;
                width: auto;
            }
        }
        
        @media (max-width: 480px) {
            .container {
                padding: 0 15px;
            }
            
            .header-container {
                height: 60px;
            }
            
            .main-content {
                padding-top: 60px;
            }
            
            .logo-img {
                height: 40px;
            }
            
            .nav-menu {
                gap: 0.5rem;
            }
            
            .nav-menu a {
                font-size: 0.7rem;
            }
            
            .header-right {
                gap: 8px;
            }
            
            .user-trigger {
                padding: 6px 10px;
            }
        }
        
        @media (max-width: 1024px) {
            footer .footer-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 32px !important;
            }
        }
        
        @media (max-width: 640px) {
            footer .footer-grid {
                grid-template-columns: 1fr !important;
                text-align: center !important;
            }
            
            footer ul {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            
            .social-icons-wrapper {
                justify-content: center !important;
            }
        }
        
        .flex { display: flex; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .gap-2 { gap: 8px; }
        .gap-3 { gap: 12px; }
        .gap-4 { gap: 16px; }
        .relative { position: relative; }
        .text-sm { font-size: 0.875rem; }
        .text-white { color: #FFFFFF; }
        
        button, a { transition: all 0.2s ease; }
    </style>
</head>
<body>
    <!-- Шапка -->
    <header class="site-header">
        <div class="container">
            <div class="header-container">
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ asset('img/logo.png') }}" alt="Family Flowers" class="logo-img">
                    <span class="logo-text">Family Flowers</span>
                </a>
                
                <nav class="nav-menu">
                    <a href="{{ route('catalog.index') }}">Каталог</a>
                    <a href="{{ route('delivery') }}">Доставка</a>
                    <a href="{{ route('contacts') }}">Контакты</a>
                    <a href="{{ route('reviews.index') }}">Отзывы</a>
                </nav>
                
                <div class="header-right">
                    <a href="{{ route('cart.index') }}" class="cart-link">
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
                                    <a href="{{ route('admin.reviews.index') }}" class="dropdown-item">
                                        <svg fill="none" width="18" height="18" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                        </svg>
                                        Отзывы
                                    </a>
                                @endif
                                
                                <div class="dropdown-divider"></div>
                                
                                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
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
                            <a href="{{ route('login') }}" class="login-link">Вход</a>
                            <a href="{{ route('register') }}" class="btn-primary" style="padding: 8px 20px; font-size: 0.875rem;">Регистрация</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Контейнер для всплывающих уведомлений -->
    <div id="toast-container"></div>

    <!-- Основной контент -->
    <div class="main-content">
        @yield('content')
    </div>

<!-- Футер -->
<footer>
    <div class="container">
        <div class="footer-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 40px; margin-bottom: 48px;">
            <div>
                <span style="font-size: 1.3rem; font-weight: 700; color: #FFFFFF;">Family Flowers</span>
                <p style="color: #AAAAAA; font-size: 0.875rem; line-height: 1.6; margin-top: 16px;">
                    Цветы высшего качества, проверенные временем и вашими отзывами.
                </p>
            </div>
            
            <div>
                <h4 style="font-weight: 700; margin-bottom: 20px; color: #FFFFFF;">Навигация</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 10px;"><a href="{{ route('catalog.index') }}" style="color: #AAAAAA; text-decoration: none; transition: color 0.3s; font-size: 0.875rem;">Каталог</a></li>
                    <li style="margin-bottom: 10px;"><a href="{{ route('delivery') }}" style="color: #AAAAAA; text-decoration: none; transition: color 0.3s; font-size: 0.875rem;">Доставка</a></li>
                    <li style="margin-bottom: 10px;"><a href="{{ route('contacts') }}" style="color: #AAAAAA; text-decoration: none; transition: color 0.3s; font-size: 0.875rem;">Контакты</a></li>
                    <li style="margin-bottom: 10px;"><a href="{{ route('reviews.index') }}" style="color: #AAAAAA; text-decoration: none; transition: color 0.3s; font-size: 0.875rem;">Отзывы</a></li>
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
                <div class="social-icons-wrapper" style="display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 20px;">
                    <!-- VK -->
                    <a href="https://vk.com/family.flowers.premium" target="_blank" class="social-icon">
                        <i class="fab fa-vk" style="color: #AAAAAA; font-size: 1.25rem;"></i>
                    </a>
                    
                    <!-- MAX -->
                    <a href="https://max.ru/u/f9LHodD0cOJRZZvr1_tZMFv98PjOK3qOS0jO8cN2E779ngthREV72VUrZTI" target="_blank" class="social-icon" title="MAX — написать в мессенджере">
                        <img src="https://спорина.рф/bitrix/templates/sporina/img/max-messenger.svg" 
                            alt="MAX" 
                            style="width: 20px; height: 20px; display: block; filter: brightness(0) saturate(100%) invert(67%) sepia(0%) saturate(0%) hue-rotate(0deg) brightness(98%) contrast(92%);">
                    </a>
                </div>
                
                <!-- Ссылки на документы -->
                <div class="footer-links" style="margin-top: 16px;">
                    <a href="{{ route('privacy.policy') }}" style="display: block; color: #888888; font-size: 0.7rem; text-decoration: none; transition: color 0.3s; margin-bottom: 8px;">
                        Политика конфиденциальности
                    </a>
                    <a href="{{ route('privacy.agreement') }}" style="display: block; color: #888888; font-size: 0.7rem; text-decoration: none; transition: color 0.3s;">
                        Согласие на обработку ПД
                    </a>
                </div>
                

            </div>
        </div>
        
        <div style="margin-top: 32px; padding-top: 32px; border-top: 1px solid rgba(255,255,255,0.08);">
            <div style="text-align: center; color: #666666; font-size: 0.75rem;">
                <p>&copy; 2026 Family Flowers. Цветы с любовью.</p>
            </div>
        </div>
    </div>
</footer>

    <script>
        // Система всплывающих уведомлений
        class Toast {
            static show(message, type = 'success') {
                const container = document.getElementById('toast-container');
                if (!container) return;
                
                const toast = document.createElement('div');
                toast.className = 'toast-notification';
                
                const icons = {
                    success: '🌸',
                    error: '⚠️'
                };
                
                const icon = icons[type] || icons.success;
                const iconClass = type === 'success' ? 'toast-success' : 'toast-error';
                
                toast.innerHTML = `
                    <div class="toast-content ${iconClass}">
                        <div class="toast-icon">${icon}</div>
                        <div class="toast-message">${message}</div>
                        <button class="toast-close" onclick="this.closest('.toast-notification').remove()">×</button>
                    </div>
                `;
                
                container.appendChild(toast);
                
                setTimeout(() => {
                    if (toast && toast.parentNode) {
                        toast.classList.add('hide');
                        setTimeout(() => {
                            if (toast && toast.parentNode) {
                                toast.remove();
                            }
                        }, 300);
                    }
                }, 5000);
                
                const closeBtn = toast.querySelector('.toast-close');
                if (closeBtn) {
                    closeBtn.addEventListener('click', () => {
                        toast.classList.add('hide');
                        setTimeout(() => toast.remove(), 300);
                    });
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Toast.show('{{ session('success') }}', 'success');
            @endif
            
            @if(session('error'))
                Toast.show('{{ session('error') }}', 'error');
            @endif
            
            @if($errors->any())
                Toast.show('{{ $errors->first() }}', 'error');
            @endif
        });
    </script>
    
    @stack('scripts')
</body>
</html>