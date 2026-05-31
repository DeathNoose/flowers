@extends('layouts.app')

@section('title', 'Оформление заказа')

@section('content')
<div class="checkout-page">
    <div class="container">
        <h1 class="page-title">Оформление заказа</h1>
        
        <div class="checkout-grid">
            {{-- Левая колонка: Форма --}}
            <div class="checkout-form">
                <div class="form-card">
                    <h2 class="form-card-title">Контактные данные</h2>
                    
                    <!-- Ошибки валидации -->
                    <div id="validation-errors" style="display: none; background: rgba(229, 57, 53, 0.1); border: 1px solid #E53935; border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                        <div id="errors-list"></div>
                    </div>
                    
                    @if($errors->any())
                        <div style="background: rgba(229, 57, 53, 0.1); border: 1px solid #E53935; border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                            @foreach($errors->all() as $error)
                                <p style="color: #E53935; font-size: 0.875rem;">❌ {{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    
                    <form action="{{ route('order.store') }}" method="POST" id="order-form" novalidate>
                        @csrf
                        
                        {{-- Контактная информация --}}
                        <div class="form-section">
                            <h3 class="section-title">Контакты</h3>
                            
                            <div class="form-group">
                                <label for="customer_name" class="form-label">Ваше ФИО <span class="required">*</span></label>
                                <input type="text" name="customer_name" id="customer_name" required value="{{ old('customer_name') }}" class="form-input" placeholder="Иван Иванов">
                                <div class="error-message" id="customer_name-error"></div>
                            </div>
                            
                            <div class="form-group">
                                <label for="phone" class="form-label">Телефон <span class="required">*</span></label>
                                <input type="tel" name="phone" id="phone" required value="{{ old('phone') }}" class="form-input" placeholder="+7 (999) 123-45-67">
                                <div class="error-message" id="phone-error"></div>
                            </div>
                        </div>
                        
                        {{-- Адрес доставки --}}
                        <div class="form-section">
                            <h3 class="section-title">Адрес доставки</h3>
                            
                            <div class="form-group">
                                <label for="city" class="form-label">Город <span class="required">*</span></label>
                                <input type="text" name="city" id="city" required value="{{ old('city', 'Курган') }}" class="form-input" placeholder="Курган">
                                <div class="error-message" id="city-error"></div>
                            </div>
                            
                            <div class="form-group">
                                <label for="street" class="form-label">Улица <span class="required">*</span></label>
                                <input type="text" name="street" id="street" required value="{{ old('street') }}" class="form-input" placeholder="ул. Пушкина">
                                <div class="error-message" id="street-error"></div>
                            </div>
                            
                            <div class="form-row two-cols">
                                <div class="form-group">
                                    <label for="house" class="form-label">Дом <span class="required">*</span></label>
                                    <input type="text" name="house" id="house" required value="{{ old('house') }}" class="form-input" placeholder="15">
                                    <div class="error-message" id="house-error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="apartment" class="form-label">Квартира/Офис <span class="required">*</span></label>
                                    <input type="text" name="apartment" id="apartment" required value="{{ old('apartment') }}" class="form-input" placeholder="42">
                                    <div class="error-message" id="apartment-error"></div>
                                </div>
                            </div>
                            
                            <div class="form-row two-cols">
                                <div class="form-group">
                                    <label for="entrance" class="form-label">Подъезд <span class="required">*</span></label>
                                    <input type="text" name="entrance" id="entrance" required value="{{ old('entrance') }}" class="form-input" placeholder="1">
                                    <div class="error-message" id="entrance-error"></div>
                                </div>
                                <div class="form-group">
                                    <label for="floor" class="form-label">Этаж <span class="required">*</span></label>
                                    <input type="text" name="floor" id="floor" required value="{{ old('floor') }}" class="form-input" placeholder="5">
                                    <div class="error-message" id="floor-error"></div>
                                </div>
                            </div>
                            
                            <div class="form-row two-cols">
                                <div class="form-group">
                                    <label for="door_code" class="form-label">Код двери</label>
                                    <input type="text" name="door_code" id="door_code" value="{{ old('door_code') }}" class="form-input" placeholder="1234">
                                </div>
                                <div class="form-group">
                                    <label for="address_comment" class="form-label">Комментарий к адресу</label>
                                    <input type="text" name="address_comment" id="address_comment" value="{{ old('address_comment') }}" class="form-input" placeholder="Домофон не работает">
                                </div>
                            </div>
                        </div>
                        
                        {{-- Время доставки --}}
                        <div class="form-section">
                            <h3 class="section-title">Время доставки</h3>
                            
                            {{-- Кастомный календарь --}}
                            <div class="form-group">
                                <label class="form-label">Дата доставки <span class="required">*</span></label>
                                
                                <input type="hidden" name="delivery_date" id="delivery_date_input" required>
                                
                                <div class="calendar-trigger" id="calendar-trigger">
                                    <div class="calendar-trigger-content">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                        <span id="selected-date-text">Выберите дату доставки</span>
                                    </div>
                                </div>
                                
                                <div class="custom-calendar" id="custom-calendar" style="display: none;">
                                    <div class="calendar-header">
                                        <button type="button" class="calendar-nav" id="prev-month">‹</button>
                                        <div class="calendar-month-year">
                                            <span id="calendar-month">Май</span>
                                            <span id="calendar-year">2026</span>
                                        </div>
                                        <button type="button" class="calendar-nav" id="next-month">›</button>
                                    </div>
                                    
                                    <div class="calendar-weekdays">
                                        <span>Пн</span><span>Вт</span><span>Ср</span><span>Чт</span><span>Пт</span><span>Сб</span><span>Вс</span>
                                    </div>
                                    
                                    <div class="calendar-days" id="calendar-days"></div>
                                    
                                    <div class="calendar-footer">
                                        <button type="button" class="calendar-btn-clear" id="clear-date">Удалить</button>
                                        <button type="button" class="calendar-btn-today" id="today-date">Сегодня</button>
                                    </div>
                                </div>
                                
                                <div class="error-message" id="delivery_date-error"></div>
                            </div>
                            
                            <div class="form-group">
                                <label for="delivery_time" class="form-label">Время доставки <span class="required">*</span></label>
                                <select name="delivery_time" id="delivery_time" required class="form-input">
                                    <option value="">Выберите время доставки</option>
                                    @if(isset($allTimeSlots) && count($allTimeSlots) > 0)
                                        @foreach($allTimeSlots as $value => $label)
                                            @if(isset($bookedSlots) && in_array($value, $bookedSlots))
                                                <option value="{{ $value }}" disabled style="color: #ccc; background: #f5f5f5;">
                                                    {{ $label }} ❌ (занято)
                                                </option>
                                            @else
                                                <option value="{{ $value }}" {{ old('delivery_time') == $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value="" disabled>Интервалы не загружены</option>
                                    @endif
                                </select>
                                <div class="error-message" id="delivery_time-error"></div>
                            </div>
                        </div>
                        
                        {{-- Комментарий --}}
                        <div class="form-section">
                            <h3 class="section-title">Комментарий к заказу</h3>
                            <div class="form-group">
                                <textarea name="comment" id="comment" rows="3" class="form-input" placeholder="Пожелания по доставке, составу букета и т.д.">{{ old('comment') }}</textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            {{-- Правая колонка: Итоговая сумма --}}
            <div class="checkout-summary">
                <div class="summary-card">
                    <h3 class="summary-title">Ваш заказ</h3>
                    
                    <div class="order-items">
                        @foreach($items as $item)
                        <div class="order-item">
                            <span class="item-name">{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                            <span class="item-price">{{ number_format($item['total'], 0, ',', ' ') }} ₽</span>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="order-total">
                        <div class="total-row">
                            <span>Сумма товаров:</span>
                            <span>{{ number_format($subtotal, 0, ',', ' ') }} ₽</span>
                        </div>
                        
                        @if($discount > 0)
                        <div class="total-row discount">
                            <span>Скидка:</span>
                            <span>- {{ number_format($discount, 0, ',', ' ') }} ₽</span>
                        </div>
                        @endif
                        
                        <div class="total-row delivery">
                            <span>Доставка:</span>
                            <span>550 ₽</span>
                        </div>
                        
                        <div class="total-row grand-total">
                            <span>Итого к оплате:</span>
                            <span id="order-total">{{ number_format($total + 550, 0, ',', ' ') }} ₽</span>
                        </div>
                    </div>
                    
                    <button type="submit" form="order-form" id="submit-btn" class="submit-btn">
                        <span id="btn-text">Подтвердить заказ</span>
                        <span id="btn-loader" style="display: none;">
                            <svg class="spinner" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M21 12a9 9 0 1 1-6.219-8.56" stroke-linecap="round"/>
                            </svg>
                        </span>
                    </button>
                    
                    <p class="policy-text">
                        Нажимая «Подтвердить заказ», вы соглашаетесь с условиями обработки персональных данных
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Основной контейнер - ТОЛЬКО БОКОВЫЕ ОТСТУПЫ */
    .container {
        max-width: 1400px;
        width: 100%;
        margin: 0 auto;
        padding: 0 40px;
    }
    
    /* Обертка для контента страницы */
    .checkout-page {
        padding: 60px 0 80px;
    }
    
    .page-title {
        font-size: clamp(1.8rem, 5vw, 2.5rem);
        font-weight: bold;
        margin-bottom: 40px;
        color: #1A1A1A;
    }
    
    /* Сетка - 2 колонки */
    .checkout-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 40px;
        align-items: start;
    }
    
    .form-card {
        background: #FFFFFF;
        border-radius: 24px;
        padding: clamp(24px, 4vw, 32px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #F0E4E8;
    }
    
    .form-card-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 24px;
        color: #1A1A1A;
        padding-bottom: 16px;
        border-bottom: 2px solid #F0E4E8;
    }
    
    .form-section {
        margin-bottom: 28px;
        padding-bottom: 20px;
        border-bottom: 1px solid #F0E4E8;
    }
    
    .form-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    
    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: #D26F8B;
        padding-left: 12px;
        border-left: 3px solid #D26F8B;
    }
    
    .form-group {
        margin-bottom: 16px;
    }
    
    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 8px;
        color: #1A1A1A;
    }
    
    .required {
        color: #D26F8B;
    }
    
    .form-input {
        width: 100%;
        background: #FAF8F9;
        border: 1px solid #F0E4E8;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 0.9rem;
        transition: all 0.3s;
        font-family: inherit;
        box-sizing: border-box;
    }
    
    .form-input:focus {
        border-color: #D26F8B;
        outline: none;
        box-shadow: 0 0 0 3px rgba(210, 111, 139, 0.1);
    }
    
    .error-message {
        color: #E53935;
        font-size: 0.75rem;
        margin-top: 4px;
        display: none;
    }
    
    .input-error {
        border-color: #E53935 !important;
        background-color: #FFF5F5 !important;
    }
    
    .form-row {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    
    .form-row.two-cols {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    
    /* ===== КАСТОМНЫЙ КАЛЕНДАРЬ ===== */
    .calendar-trigger {
        width: 100%;
        background: #FAF8F9;
        border: 1px solid #F0E4E8;
        border-radius: 12px;
        padding: 12px 16px;
        cursor: pointer;
        transition: all 0.3s;
        position: relative;
    }
    
    .calendar-trigger:hover {
        border-color: #D26F8B;
    }
    
    .calendar-trigger-content {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #888888;
    }
    
    .calendar-trigger-content svg {
        color: #D26F8B;
        flex-shrink: 0;
    }
    
    #selected-date-text {
        color: #888888;
    }
    
    #selected-date-text.has-date {
        color: #1A1A1A;
    }
    
    .custom-calendar {
        position: absolute;
        z-index: 1000;
        background: #FFFFFF;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        border: 1px solid #F0E4E8;
        width: 320px;
        margin-top: 8px;
        background: white;
    }
    
    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px;
        border-bottom: 1px solid #F0E4E8;
    }
    
    .calendar-nav {
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
        color: #D26F8B;
        padding: 4px 12px;
        border-radius: 8px;
        transition: all 0.3s;
    }
    
    .calendar-nav:hover {
        background: rgba(210, 111, 139, 0.1);
        color: #E89BB3;
    }
    
    .calendar-month-year {
        font-weight: 600;
        font-size: 1rem;
        color: #1A1A1A;
    }
    
    .calendar-weekdays {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        text-align: center;
        padding: 12px 8px;
        font-size: 0.75rem;
        font-weight: 600;
        color: #888888;
        border-bottom: 1px solid #F0E4E8;
    }
    
    .calendar-days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        padding: 8px;
        gap: 2px;
    }
    
    .calendar-day {
        text-align: center;
        padding: 10px 0;
        font-size: 0.85rem;
        cursor: pointer;
        border-radius: 50%;
        transition: all 0.2s;
        color: #1A1A1A;
    }
    
    .calendar-day:hover:not(.disabled):not(.selected) {
        background: rgba(210, 111, 139, 0.1);
        color: #D26F8B;
    }
    
    .calendar-day.selected {
        background: #D26F8B;
        color: white;
    }
    
    .calendar-day.disabled {
        color: #CCCCCC;
        cursor: not-allowed;
        background: #F5F5F5;
    }
    
    .calendar-day.other-month {
        color: #CCCCCC;
    }
    
    .calendar-footer {
        display: flex;
        justify-content: space-between;
        padding: 12px 16px;
        border-top: 1px solid #F0E4E8;
        gap: 12px;
    }
    
    .calendar-btn-clear, .calendar-btn-today {
        flex: 1;
        background: #FAF8F9;
        border: 1px solid #F0E4E8;
        border-radius: 30px;
        padding: 8px 12px;
        cursor: pointer;
        font-size: 0.8rem;
        transition: all 0.3s;
        color: #666666;
    }
    
    .calendar-btn-clear:hover, .calendar-btn-today:hover {
        background: #D26F8B;
        border-color: #D26F8B;
        color: white;
    }
    
    /* Карточка итоговой суммы */
    .summary-card {
        background: #FFFFFF;
        border-radius: 24px;
        padding: clamp(24px, 4vw, 32px);
        position: sticky;
        top: 100px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #F0E4E8;
    }
    
    .summary-title {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 20px;
        color: #1A1A1A;
        padding-bottom: 12px;
        border-bottom: 1px solid #F0E4E8;
    }
    
    .order-items {
        margin-bottom: 20px;
        max-height: 300px;
        overflow-y: auto;
    }
    
    .order-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid #F0E4E8;
        gap: 15px;
    }
    
    .item-name {
        color: #4A4A4A;
        font-size: 0.9rem;
        flex: 1;
    }
    
    .item-price {
        color: #D26F8B;
        font-weight: 600;
        white-space: nowrap;
    }
    
    .order-total {
        border-top: 1px solid #F0E4E8;
        padding-top: 16px;
    }
    
    .total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        color: #666666;
        font-size: 0.9rem;
        gap: 15px;
    }
    
    .total-row.discount {
        color: #4CAF50;
    }
    
    .total-row.delivery {
        color: #D26F8B;
        font-weight: 500;
    }
    
    .total-row.grand-total {
        font-size: 1.2rem;
        font-weight: bold;
        color: #1A1A1A;
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px solid #F0E4E8;
    }
    
    .submit-btn {
        width: 100%;
        background: #D26F8B;
        color: #FFFFFF;
        font-weight: 600;
        padding: 14px 24px;
        border-radius: 40px;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 16px;
    }
    
    .submit-btn:hover {
        background: #E89BB3;
        transform: translateY(-2px);
    }
    
    .submit-btn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }
    
    .spinner {
        width: 20px;
        height: 20px;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .policy-text {
        font-size: 0.7rem;
        color: #888888;
        text-align: center;
        margin-top: 16px;
    }
    
    /* Адаптивность */
    @media (max-width: 1024px) {
        .container {
            padding: 0 30px;
        }
        
        .checkout-page {
            padding: 50px 0 70px;
        }
        
        .checkout-grid {
            gap: 30px;
        }
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 0 20px;
        }
        
        .checkout-page {
            padding: 40px 0 60px;
        }
        
        .checkout-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }
        
        .form-row.two-cols {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        
        .summary-card {
            position: static;
        }
        
        .order-item {
            flex-wrap: wrap;
            gap: 8px;
        }
        
        .total-row {
            flex-wrap: wrap;
            gap: 8px;
        }
        
        .custom-calendar {
            width: 280px;
            right: 0;
        }
    }
    
    @media (max-width: 480px) {
        .container {
            padding: 0 15px;
        }
        
        .checkout-page {
            padding: 30px 0 50px;
        }
        
        .form-card, .summary-card {
            padding: 20px;
        }
        
        .page-title {
            margin-bottom: 30px;
            font-size: 1.8rem;
        }
        
        .section-title {
            font-size: 1rem;
        }
        
        .form-input {
            padding: 10px 14px;
            font-size: 0.85rem;
        }
        
        .submit-btn {
            padding: 12px 20px;
            font-size: 0.9rem;
        }
        
        .custom-calendar {
            width: 260px;
            right: -10px;
        }
        
        .calendar-day {
            padding: 8px 0;
            font-size: 0.75rem;
        }
    }
    
    input:focus, textarea:focus, select:focus {
        border-color: #D26F8B !important;
        outline: none;
        box-shadow: 0 0 0 3px rgba(210, 111, 139, 0.15) !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('order-form');
    const submitBtn = document.getElementById('submit-btn');
    const btnText = document.getElementById('btn-text');
    const btnLoader = document.getElementById('btn-loader');
    
    const errorMessages = {
        required: {
            customer_name: 'Пожалуйста, укажите ваше имя',
            phone: 'Пожалуйста, укажите номер телефона',
            city: 'Пожалуйста, укажите город',
            street: 'Пожалуйста, укажите улицу',
            house: 'Пожалуйста, укажите номер дома',
            apartment: 'Пожалуйста, укажите квартиру/офис',
            entrance: 'Пожалуйста, укажите подъезд',
            floor: 'Пожалуйста, укажите этаж',
            delivery_date: 'Пожалуйста, выберите дату доставки',
            delivery_time: 'Пожалуйста, выберите время доставки'
        },
        pattern: {
            customer_name: 'Имя может содержать только буквы, пробелы и дефисы',
            phone: 'Введите номер в формате +7 (999) 123-45-67'
        },
        phone_length: 'Номер телефона должен содержать 10 цифр'
    };
    
    function validateName(name) {
        const nameRegex = /^[а-яА-ЯёЁa-zA-Z\s\-]+$/;
        if (!name.trim()) return errorMessages.required.customer_name;
        if (!nameRegex.test(name)) return errorMessages.pattern.customer_name;
        return null;
    }
    
    function validatePhone(phone) {
        const cleanPhone = phone.replace(/\D/g, '');
        const digitCount = cleanPhone.length;
        if (!phone.trim()) return errorMessages.required.phone;
        if (digitCount !== 11 && digitCount !== 10) return errorMessages.phone_length;
        return null;
    }
    
    function validateRequired(value, fieldName) {
        if (!value || !value.trim()) return errorMessages.required[fieldName];
        return null;
    }
    
    function showError(input, message) {
        const errorDiv = document.getElementById(`${input.id}-error`);
        if (errorDiv) {
            errorDiv.textContent = message;
            errorDiv.style.display = 'block';
        }
        input.classList.add('input-error');
    }
    
    function clearError(input) {
        const errorDiv = document.getElementById(`${input.id}-error`);
        if (errorDiv) {
            errorDiv.style.display = 'none';
            errorDiv.textContent = '';
        }
        input.classList.remove('input-error');
    }
    
    function formatPhoneNumber(value) {
        let digits = value.replace(/\D/g, '');
        if (digits.length > 11) digits = digits.slice(0, 11);
        if (digits.length > 0 && digits[0] === '8') digits = '7' + digits.slice(1);
        let formatted = '';
        if (digits.length > 0) {
            formatted = '+7';
            if (digits.length > 1) formatted += ' (' + digits.slice(1, 4);
            if (digits.length > 4) formatted += ') ' + digits.slice(4, 7);
            if (digits.length > 7) formatted += '-' + digits.slice(7, 9);
            if (digits.length > 9) formatted += '-' + digits.slice(9, 11);
        }
        return formatted;
    }
    
    const fields = ['customer_name', 'phone', 'city', 'street', 'house', 'apartment', 'entrance', 'floor', 'delivery_time'];
    
    fields.forEach(fieldName => {
        const field = document.getElementById(fieldName);
        if (field) {
            field.addEventListener('input', function() {
                let error = null;
                if (fieldName === 'customer_name') error = validateName(this.value);
                else if (fieldName === 'phone') error = validatePhone(this.value);
                else error = validateRequired(this.value, fieldName);
                
                if (error) showError(this, error);
                else clearError(this);
                
                const errorsContainer = document.getElementById('validation-errors');
                if (errorsContainer) errorsContainer.style.display = 'none';
            });
            
            field.addEventListener('blur', function() {
                let error = null;
                if (fieldName === 'customer_name') error = validateName(this.value);
                else if (fieldName === 'phone') error = validatePhone(this.value);
                else error = validateRequired(this.value, fieldName);
                
                if (error) showError(this, error);
                else clearError(this);
            });
        }
    });
    
    const phoneInput = document.getElementById('phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function() {
            const formatted = formatPhoneNumber(this.value);
            if (formatted !== this.value) this.value = formatted;
        });
        
        phoneInput.addEventListener('keydown', function(e) {
            const allowedKeys = ['Backspace', 'Delete', 'Tab', 'Escape', 'Enter', 'ArrowLeft', 'ArrowRight', 'ArrowUp', 'ArrowDown', 'Home', 'End'];
            if (allowedKeys.includes(e.key)) return;
            if (!/^[\d\+\(\)\-\s]$/.test(e.key)) e.preventDefault();
        });
    }
    
    form.setAttribute('novalidate', true);
    
    form.addEventListener('submit', function(e) {
        let isValid = true;
        const errors = {};
        
        const fieldsToValidate = [
            { id: 'customer_name', type: 'name' },
            { id: 'phone', type: 'phone' },
            { id: 'city', type: 'required' },
            { id: 'street', type: 'required' },
            { id: 'house', type: 'required' },
            { id: 'apartment', type: 'required' },
            { id: 'entrance', type: 'required' },
            { id: 'floor', type: 'required' },
            { id: 'delivery_time', type: 'required' }
        ];
        
        // Проверка даты из скрытого поля
        const deliveryDateInput = document.getElementById('delivery_date_input');
        if (!deliveryDateInput.value) {
            const dateError = errorMessages.required.delivery_date;
            const dateErrorDiv = document.getElementById('delivery_date-error');
            if (dateErrorDiv) {
                dateErrorDiv.textContent = dateError;
                dateErrorDiv.style.display = 'block';
            }
            document.querySelector('.calendar-trigger').classList.add('input-error');
            errors.delivery_date = dateError;
            isValid = false;
        } else {
            const dateErrorDiv = document.getElementById('delivery_date-error');
            if (dateErrorDiv) dateErrorDiv.style.display = 'none';
            document.querySelector('.calendar-trigger')?.classList.remove('input-error');
        }
        
        fieldsToValidate.forEach(fieldInfo => {
            const field = document.getElementById(fieldInfo.id);
            if (!field) return;
            
            let error = null;
            if (fieldInfo.type === 'name') error = validateName(field.value);
            else if (fieldInfo.type === 'phone') error = validatePhone(field.value);
            else error = validateRequired(field.value, fieldInfo.id);
            
            if (error) {
                showError(field, error);
                errors[fieldInfo.id] = error;
                isValid = false;
            }
        });
        
        const errorsContainer = document.getElementById('validation-errors');
        const errorsList = document.getElementById('errors-list');
        
        if (!isValid) {
            e.preventDefault();
            const errorMessagesList = Object.values(errors);
            errorsList.innerHTML = errorMessagesList.map(msg => `<p style="color: #E53935; font-size: 0.875rem; margin-bottom: 5px;">❌ ${msg}</p>`).join('');
            errorsContainer.style.display = 'block';
            
            const firstError = document.querySelector('.input-error');
            if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        } else {
            btnText.style.display = 'none';
            btnLoader.style.display = 'inline-block';
            submitBtn.disabled = true;
        }
    });
});

// ===== КАСТОМНЫЙ КАЛЕНДАРЬ =====
(function() {
    let currentDate = new Date();
    let selectedDate = null;
    let minDate = new Date();
    minDate.setHours(0, 0, 0, 0);
    
    const calendarEl = document.getElementById('custom-calendar');
    const triggerEl = document.getElementById('calendar-trigger');
    const selectedDateText = document.getElementById('selected-date-text');
    const deliveryDateInput = document.getElementById('delivery_date_input');
    const monthSpan = document.getElementById('calendar-month');
    const yearSpan = document.getElementById('calendar-year');
    const daysContainer = document.getElementById('calendar-days');
    
    const monthNames = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
    
    function formatDate(date) {
        if (!date) return '';
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }
    
    function formatDisplayDate(date) {
        if (!date) return 'Выберите дату доставки';
        const day = date.getDate();
        const month = monthNames[date.getMonth()];
        const year = date.getFullYear();
        return `${day} ${month} ${year}`;
    }
    
    function isDateDisabled(date) {
        return date < minDate;
    }
    
    function renderCalendar() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();
        
        monthSpan.textContent = monthNames[month];
        yearSpan.textContent = year;
        
        const firstDayOfMonth = new Date(year, month, 1);
        const startDayOfWeek = firstDayOfMonth.getDay();
        let startOffset = startDayOfWeek === 0 ? 6 : startDayOfWeek - 1;
        
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const prevMonthDays = new Date(year, month, 0).getDate();
        
        daysContainer.innerHTML = '';
        
        for (let i = startOffset - 1; i >= 0; i--) {
            const day = prevMonthDays - i;
            const date = new Date(year, month - 1, day);
            const dayDiv = document.createElement('div');
            dayDiv.className = 'calendar-day other-month disabled';
            dayDiv.textContent = day;
            daysContainer.appendChild(dayDiv);
        }
        
        for (let day = 1; day <= daysInMonth; day++) {
            const date = new Date(year, month, day);
            const isDisabled = isDateDisabled(date);
            const isSelected = selectedDate && formatDate(date) === formatDate(selectedDate);
            
            const dayDiv = document.createElement('div');
            dayDiv.className = 'calendar-day';
            if (isDisabled) dayDiv.classList.add('disabled');
            if (isSelected) dayDiv.classList.add('selected');
            dayDiv.textContent = day;
            
            if (!isDisabled) {
                dayDiv.addEventListener('click', (function(d) {
                    return function() {
                        selectedDate = d;
                        selectedDateText.textContent = formatDisplayDate(selectedDate);
                        selectedDateText.classList.add('has-date');
                        deliveryDateInput.value = formatDate(selectedDate);
                        calendarEl.style.display = 'none';
                        
                        const changeEvent = new Event('change');
                        deliveryDateInput.dispatchEvent(changeEvent);
                        
                        if (document.getElementById('delivery_date-error')) {
                            document.getElementById('delivery_date-error').style.display = 'none';
                        }
                        triggerEl.classList.remove('input-error');
                    };
                })(date));
            }
            
            daysContainer.appendChild(dayDiv);
        }
        
        const totalCells = 42;
        const currentCells = startOffset + daysInMonth;
        const remainingCells = totalCells - currentCells;
        
        for (let day = 1; day <= remainingCells; day++) {
            const dayDiv = document.createElement('div');
            dayDiv.className = 'calendar-day other-month disabled';
            dayDiv.textContent = day;
            daysContainer.appendChild(dayDiv);
        }
    }
    
    triggerEl.addEventListener('click', function(e) {
        e.stopPropagation();
        const isVisible = calendarEl.style.display === 'block';
        calendarEl.style.display = isVisible ? 'none' : 'block';
        if (!isVisible) {
            renderCalendar();
        }
    });
    
    document.addEventListener('click', function(e) {
        if (calendarEl && !calendarEl.contains(e.target) && !triggerEl.contains(e.target)) {
            calendarEl.style.display = 'none';
        }
    });
    
    document.getElementById('prev-month').addEventListener('click', function(e) {
        e.stopPropagation();
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });
    
    document.getElementById('next-month').addEventListener('click', function(e) {
        e.stopPropagation();
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });
    
    document.getElementById('today-date').addEventListener('click', function(e) {
        e.stopPropagation();
        currentDate = new Date();
        if (!isDateDisabled(currentDate)) {
            selectedDate = currentDate;
            selectedDateText.textContent = formatDisplayDate(selectedDate);
            selectedDateText.classList.add('has-date');
            deliveryDateInput.value = formatDate(selectedDate);
            calendarEl.style.display = 'none';
            
            const changeEvent = new Event('change');
            deliveryDateInput.dispatchEvent(changeEvent);
        }
        renderCalendar();
    });
    
    document.getElementById('clear-date').addEventListener('click', function(e) {
        e.stopPropagation();
        selectedDate = null;
        selectedDateText.textContent = 'Выберите дату доставки';
        selectedDateText.classList.remove('has-date');
        deliveryDateInput.value = '';
        calendarEl.style.display = 'none';
        
        const changeEvent = new Event('change');
        deliveryDateInput.dispatchEvent(changeEvent);
        renderCalendar();
    });
    
    const oldDate = '{{ old("delivery_date") }}';
    if (oldDate && oldDate !== '') {
        const parts = oldDate.split('-');
        if (parts.length === 3) {
            selectedDate = new Date(parts[0], parts[1] - 1, parts[2]);
            selectedDateText.textContent = formatDisplayDate(selectedDate);
            selectedDateText.classList.add('has-date');
            deliveryDateInput.value = formatDate(selectedDate);
        }
    }
})();

// Обновление доступных интервалов при смене даты
const deliveryDateInput = document.getElementById('delivery_date_input');
const deliveryTimeSelect = document.getElementById('delivery_time');

if (deliveryDateInput && deliveryTimeSelect) {
    deliveryDateInput.addEventListener('change', function() {
        const selectedDate = this.value;
        const deliveryTime = document.getElementById('delivery_time').value;
        
        if (!selectedDate) return;
        
        deliveryTimeSelect.innerHTML = '<option value="">Загрузка...</option>';
        
        fetch(`/get-booked-time-slots?date=${selectedDate}`)
            .then(response => response.json())
            .then(data => {
                deliveryTimeSelect.innerHTML = '<option value="">Выберите время доставки</option>';
                
                data.allTimeSlots.forEach(slot => {
                    const option = document.createElement('option');
                    option.value = slot.value;
                    option.textContent = slot.label;
                    
                    if (data.bookedSlots.includes(slot.value)) {
                        option.disabled = true;
                        option.textContent = slot.label + ' ❌ (занято)';
                        option.style.color = '#ccc';
                        option.style.background = '#f5f5f5';
                    }
                    
                    if (deliveryTime === slot.value && !data.bookedSlots.includes(slot.value)) {
                        option.selected = true;
                    }
                    
                    deliveryTimeSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Ошибка:', error);
                deliveryTimeSelect.innerHTML = '<option value="">Ошибка загрузки</option>';
            });
    });
}
</script>
@endsection