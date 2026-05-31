@extends('layouts.app')

@section('title', 'Доставка')

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    {{-- Заголовок как на странице контакты --}}
    <div style="text-align: center; margin-bottom: 60px;">
        <h1 style="font-size: clamp(2rem, 5vw, 3rem); font-weight: bold; margin-bottom: 16px; color: #1A1A1A;">
            Доставка <span style="color: #D26F8B;">цветов</span>
        </h1>
        <p style="color: #888888; font-size: clamp(0.875rem, 3vw, 1.125rem); max-width: 600px; margin: 0 auto;">
            Быстрая и бережная доставка ваших цветов в любой уголок города
        </p>
    </div>
    
    <div class="delivery-grid">
        {{-- Левая колонка: Стоимость доставки --}}
        <div class="delivery-card">
            <h2 class="card-title">Стоимость доставки</h2>
            
            <div class="delivery-options">
                <div class="delivery-option">
                    <div class="option-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="option-content">
                        <h3 class="option-title">По городу</h3>
                        <div class="option-price">550 ₽</div>
                        <p class="option-text">Фиксированная стоимость доставки</p>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Правая колонка: Время доставки --}}
        <div class="delivery-card">
            <h2 class="card-title">Время доставки</h2>
            
            <div class="delivery-options">
                <div class="delivery-option">
                    <div class="option-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="option-content">
                        <h3 class="option-title">Ежедневно</h3>
                        <div class="option-price">8:30 — 22:00</div>
                        <p class="option-text">Доставка осуществляется без выходных и перерывов</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Условия доставки --}}
    <div class="conditions-wrapper">
        <div class="conditions-card">
            <div class="conditions-grid">
                <div class="condition-item">
                    <div class="condition-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6M17 13l1.5 6M9 21h6M12 18v3" />
                        </svg>
                    </div>
                    <div class="condition-text-block">
                        <h3 class="condition-title-small">Стоимость доставки</h3>
                        <p>Не зависит от количества цветов в заказе</p>
                    </div>
                </div>
                
                <div class="condition-item">
                    <div class="condition-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <div class="condition-text-block">
                        <h3 class="condition-title-small">Упаковка</h3>
                        <p>Цветы упаковываются в специальную упаковку для сохранения свежести</p>
                    </div>
                </div>
                
                <div class="condition-item">
                    <div class="condition-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="condition-text-block">
                        <h3 class="condition-title-small">Связь с курьером</h3>
                        <p>Курьер свяжется с вами перед доставкой для подтверждения времени</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Контактная информация для вопросов о доставке --}}
    <div class="contact-block">
        <h2 class="contact-title">Остались вопросы о доставке?</h2>
        <p class="contact-text">
            Свяжитесь с нами, и мы поможем подобрать удобный способ доставки
        </p>
        <div class="contact-buttons">
            <a href="tel:+79630101012" class="btn-phone">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                +7 (963) 010-10-12
            </a>
            <a href="{{ route('contacts') }}" class="btn-email">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Написать нам
            </a>
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
    
    /* Сетка */
    .delivery-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 40px;
        margin-bottom: 40px;
    }
    
    /* Карточки */
    .delivery-card {
        background: #FFFFFF;
        border-radius: 24px;
        padding: clamp(24px, 4vw, 32px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #F0E4E8;
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .delivery-card:hover {
        transform: translateY(-4px);
    }
    
    .card-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 28px;
        color: #1A1A1A;
        padding-bottom: 16px;
        border-bottom: 2px solid #F0E4E8;
    }
    
    /* Опции доставки */
    .delivery-options {
        display: flex;
        flex-direction: column;
        gap: 24px;
        flex: 1;
    }
    
    .delivery-option {
        display: flex;
        gap: 16px;
        flex: 1;
    }
    
    .option-icon {
        width: 56px;
        height: 56px;
        background: rgba(210, 111, 139, 0.1);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #D26F8B;
    }
    
    .option-content {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .option-title {
        font-weight: 600;
        font-size: 1.25rem;
        margin-bottom: 8px;
        color: #1A1A1A;
    }
    
    .option-price {
        color: #D26F8B;
        font-weight: 700;
        font-size: 1.75rem;
        margin: 8px 0;
    }
    
    .option-text {
        color: #888888;
        font-size: 0.875rem;
        margin-top: 4px;
        line-height: 1.4;
    }
    
    /* Условия доставки */
    .conditions-wrapper {
        margin-bottom: 40px;
    }
    
    .conditions-card {
        background: #FFFFFF;
        border-radius: 24px;
        padding: clamp(24px, 4vw, 32px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #F0E4E8;
    }
    
    .conditions-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }
    
    .condition-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 16px;
    }
    
    .condition-icon {
        width: 60px;
        height: 60px;
        background: rgba(210, 111, 139, 0.1);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #D26F8B;
    }
    
    .condition-text-block {
        flex: 1;
    }
    
    .condition-title-small {
        font-weight: 600;
        font-size: 1.125rem;
        margin-bottom: 8px;
        color: #D26F8B;
    }
    
    .condition-text-block p {
        color: #666666;
        font-size: 0.875rem;
        line-height: 1.5;
        margin: 0;
    }
    
    /* Контактный блок */
    .contact-block {
        background: #FFFFFF;
        border-radius: 24px;
        padding: clamp(28px, 5vw, 40px);
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #F0E4E8;
        margin-top: 40px;
    }
    
    .contact-title {
        font-size: clamp(1.3rem, 4vw, 1.5rem);
        font-weight: bold;
        margin-bottom: 16px;
        color: #1A1A1A;
    }
    
    .contact-text {
        color: #666666;
        margin-bottom: 28px;
        font-size: 1rem;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .contact-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }
    
    .btn-phone, .btn-email {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 28px;
        border-radius: 40px;
        text-decoration: none;
        transition: all 0.3s;
        font-weight: 600;
        font-size: 1rem;
    }
    
    .btn-phone {
        background: #D26F8B;
        color: #FFFFFF;
    }
    
    .btn-phone:hover {
        background: #E89BB3;
        transform: translateY(-2px);
    }
    
    .btn-email {
        border: 2px solid #D26F8B;
        color: #D26F8B;
        background: transparent;
    }
    
    .btn-email:hover {
        background: #D26F8B;
        color: #FFFFFF;
        transform: translateY(-2px);
    }
    
    /* Адаптивность */
    @media (max-width: 1024px) {
        .container {
            padding: 0 20px;
        }
        
        .delivery-grid {
            gap: 30px;
        }
        
        .conditions-grid {
            gap: 20px;
        }
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 0 16px;
        }
        
        .delivery-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }
        
        .delivery-option {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        .option-icon {
            margin: 0 auto;
        }
        
        .option-content {
            align-items: center;
        }
        
        .conditions-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }
        
        .condition-item {
            flex-direction: row;
            text-align: left;
        }
        
        .contact-buttons {
            flex-direction: column;
            align-items: stretch;
        }
        
        .btn-phone, .btn-email {
            justify-content: center;
        }
    }
    
    @media (max-width: 640px) {
        .conditions-grid {
            grid-template-columns: 1fr;
        }
        
        .condition-item {
            flex-direction: column;
            text-align: center;
        }
        
        .condition-icon {
            margin: 0 auto;
        }
    }
    
    @media (max-width: 480px) {
        .container {
            padding: 0 12px;
        }
        
        .delivery-card, .conditions-card {
            padding: 20px;
        }
        
        .card-title {
            font-size: 1.3rem;
            margin-bottom: 20px;
        }
        
        .option-price {
            font-size: 1.5rem;
        }
        
        .option-title {
            font-size: 1.1rem;
        }
        
        .btn-phone, .btn-email {
            padding: 10px 20px;
            font-size: 0.9rem;
        }
    }
</style>
@endsection