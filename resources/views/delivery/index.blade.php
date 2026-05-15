@extends('layouts.app')

@section('title', 'Доставка')

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    {{-- Заголовок --}}
    <div style="text-align: center; margin-bottom: 60px;">
        <h1 style="font-size: 3rem; font-weight: bold; margin-bottom: 16px; color: #1A1A1A;">
            Доставка <span style="color: #D26F8B;">цветов</span>
        </h1>
        <p style="color: #888888; font-size: 1.125rem; max-width: 600px; margin: 0 auto;">
            Быстрая и бережная доставка ваших цветов в любой уголок города
        </p>
    </div>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
        {{-- Левая колонка: Стоимость доставки --}}
        <div style="background: #FFFFFF; border-radius: 24px; padding: 32px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
            <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 24px; color: #1A1A1A;">Стоимость доставки</h2>
            
            <div style="display: flex; flex-direction: column; gap: 32px;">
                <!-- Доставка по городу -->
                <div style="display: flex; gap: 16px;">
                    <div style="width: 48px; height: 48px; background: rgba(210, 111, 139, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg style="width: 24px; height: 24px; color: #D26F8B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <h3 style="font-weight: 600; font-size: 1.25rem; margin-bottom: 8px; color: #1A1A1A;">По городу</h3>
                        <p style="color: #666666; line-height: 1.5; margin-bottom: 8px;">
                            Доставка по городу осуществляется независимо от расстояния.
                        </p>
                        <p style="color: #D26F8B; font-weight: 700; font-size: 1.5rem; margin-top: 8px;">
                            550 ₽
                        </p>
                        <p style="color: #888888; font-size: 0.875rem; margin-top: 4px;">
                            Фиксированная стоимость
                        </p>
                    </div>
                </div>
                
                <!-- Доставка по Заозёрному -->
                <div style="display: flex; gap: 16px;">
                    <div style="width: 48px; height: 48px; background: rgba(210, 111, 139, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg style="width: 24px; height: 24px; color: #D26F8B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <div>
                        <h3 style="font-weight: 600; font-size: 1.25rem; margin-bottom: 8px; color: #1A1A1A;">По Заозёрному</h3>
                        <p style="color: #666666; line-height: 1.5; margin-bottom: 8px;">
                            Доставка по Заозёрному микрорайону независимо от расстояния.
                        </p>
                        <p style="color: #D26F8B; font-weight: 700; font-size: 1.5rem; margin-top: 8px;">
                            450 ₽
                        </p>
                        <p style="color: #888888; font-size: 0.875rem; margin-top: 4px;">
                            Фиксированная стоимость
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Правая колонка: Время доставки и условия --}}
        <div style="background: #FFFFFF; border-radius: 24px; padding: 32px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
            <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 24px; color: #1A1A1A;">Время и условия</h2>
            
            <div style="display: flex; flex-direction: column; gap: 24px;">
                <!-- Время доставки -->
                <div>
                    <h3 style="font-weight: 600; font-size: 1.125rem; margin-bottom: 12px; color: #D26F8B;">⏰ Время доставки</h3>
                    <p style="color: #666666; line-height: 1.5; font-size: 1.125rem;">
                        <strong style="color: #1A1A1A;">8:30 — 22:00</strong>
                    </p>
                    <p style="color: #888888; font-size: 0.875rem; margin-top: 4px;">
                        Доставка осуществляется ТОЛЬКО в это время
                    </p>
                </div>
                
                <!-- Важно знать -->
                <div style="margin-top: 16px;">
                    <h3 style="font-weight: 600; font-size: 1.125rem; margin-bottom: 16px; color: #1A1A1A;">Важно знать</h3>
                    <ul style="color: #666666; font-size: 0.875rem; list-style: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 12px; display: flex; align-items: flex-start; gap: 8px;">
                            <span style="color: #D26F8B; font-weight: bold;">✓</span>
                            <span>Стоимость доставки не зависит от количества цветов</span>
                        </li>
                        <li style="margin-bottom: 12px; display: flex; align-items: flex-start; gap: 8px;">
                            <span style="color: #D26F8B; font-weight: bold;">✓</span>
                            <span>Стоимость доставки не зависит от расстояния (в пределах города/Заозёрного)</span>
                        </li>
                        <li style="margin-bottom: 12px; display: flex; align-items: flex-start; gap: 8px;">
                            <span style="color: #D26F8B; font-weight: bold;">✓</span>
                            <span>Цветы упаковываются в специальную упаковку для сохранения свежести</span>
                        </li>
                        <li style="margin-bottom: 12px; display: flex; align-items: flex-start; gap: 8px;">
                            <span style="color: #D26F8B; font-weight: bold;">✓</span>
                            <span>Курьер свяжется с вами перед доставкой</span>
                        </li>
                        <li style="display: flex; align-items: flex-start; gap: 8px;">
                            <span style="color: #D26F8B; font-weight: bold;">✓</span>
                            <span>Возможна оплата наличными или картой при получении</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Контактная информация для вопросов о доставке --}}
    <div style="margin-top: 40px;">
        <div style="background: #FFFFFF; border-radius: 24px; padding: 32px; text-align: center; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
            <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 16px; color: #1A1A1A;">Остались вопросы о доставке?</h2>
            <p style="color: #666666; margin-bottom: 24px;">
                Свяжитесь с нами, и мы поможем подобрать удобный способ доставки
            </p>
            <div style="display: flex; justify-content: center; gap: 24px; flex-wrap: wrap;">
                <a href="tel:+79630101012" style="display: inline-flex; align-items: center; gap: 8px; background: #D26F8B; color: #FFFFFF; padding: 12px 24px; border-radius: 40px; text-decoration: none; transition: all 0.3s;">
                    <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    +7 (963) 010-10-12
                </a>
                <a href="{{ route('contacts') }}" style="display: inline-flex; align-items: center; gap: 8px; border: 2px solid #D26F8B; color: #D26F8B; padding: 12px 24px; border-radius: 40px; text-decoration: none; transition: all 0.3s;">
                    <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Написать нам
                </a>
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
        [style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
            gap: 32px !important;
        }
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 0 16px;
        }
        h1 {
            font-size: 2rem !important;
        }
    }
    
    a[href="tel:+79630101012"]:hover {
        background: #E89BB3 !important;
        transform: translateY(-2px);
    }
    
    a[href="{{ route('contacts') }}"]:hover {
        background: #D26F8B !important;
        color: #FFFFFF !important;
    }
</style>
@endsection