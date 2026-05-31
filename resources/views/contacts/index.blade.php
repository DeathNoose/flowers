@extends('layouts.app')

@section('title', 'Контакты')

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    {{-- Заголовок --}}
    <div style="text-align: center; margin-bottom: 60px;">
        <h1 style="font-size: clamp(2rem, 5vw, 3rem); font-weight: bold; margin-bottom: 16px; color: #1A1A1A;">
            Наши <span style="color: #D26F8B;">контакты</span>
        </h1>
        <p style="color: #888888; font-size: clamp(0.875rem, 3vw, 1.125rem); max-width: 600px; margin: 0 auto;">
            Удовольствие от хорошего качества длится дольше, чем радость от низкой цены.<br>
            Свяжитесь с нами любым удобным способом
        </p>
    </div>
    
    <div class="contacts-grid">
        {{-- Левая колонка: Контактная информация --}}
        <div>
            <div style="background: #FFFFFF; border-radius: 24px; padding: clamp(24px, 5vw, 32px); height: 100%; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
                <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 24px; color: #1A1A1A;">Свяжитесь с нами</h2>
                
                {{-- Сообщения об успехе/ошибке --}}
                @if(session('success'))
                    <div style="margin-bottom: 24px; padding: 16px; background: rgba(210, 111, 139, 0.1); border: 1px solid #D26F8B; border-radius: 12px; color: #D26F8B;">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div style="margin-bottom: 24px; padding: 16px; background: rgba(229, 57, 53, 0.1); border: 1px solid #E53935; border-radius: 12px; color: #E53935;">
                        {{ session('error') }}
                    </div>
                @endif
                
                {{-- Контактная информация --}}
                <div style="display: flex; flex-direction: column; gap: 24px;">
                    <!-- Адрес -->
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg style="width: 24px; height: 24px; color: #D26F8B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 style="font-weight: 600; font-size: 1.125rem; margin-bottom: 8px; color: #1A1A1A;">Адрес</h3>
                            <p style="color: #666666; line-height: 1.5;">
                                г. Курган, 3-й микрорайон, д. 30<br>
                                ТЦ "Метрополис", цокольный этаж<br>
                                Ориентир: у кинотеатра "Современник", напротив касс супермаркета "Метрополис"
                            </p>
                            <p style="color: #888888; font-size: 0.875rem; margin-top: 8px;">📍 Остановка "Культурный центр Современник" — 1 минута пешком</p>
                        </div>
                    </div>

                    <!-- Телефон -->
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg style="width: 24px; height: 24px; color: #D26F8B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <h3 style="font-weight: 600; font-size: 1.125rem; margin-bottom: 8px; color: #1A1A1A;">Телефон</h3>
                            <p>
                                <a href="tel:+79630101012" class="contact-link">+7 (963) 010-10-12</a>
                            </p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg style="width: 24px; height: 24px; color: #D26F8B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 style="font-weight: 600; font-size: 1.125rem; margin-bottom: 8px; color: #1A1A1A;">Email</h3>
                            <p>
                                <a href="mailto:family.flowers@mail.ru" class="contact-link">family.flowers@mail.ru</a>
                            </p>
                        </div>
                    </div>

                    <!-- Режим работы -->
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg style="width: 24px; height: 24px; color: #D26F8B;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 style="font-weight: 600; font-size: 1.125rem; margin-bottom: 8px; color: #1A1A1A;">Режим работы</h3>
                            <p style="color: #4A4A4A;">
                                Ежедневно: <span style="color: #1A1A1A;">8:00 – 22:00</span><br>
                                Без обеда, без выходных
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Социальные сети (VK + MAX) --}}
                <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid #F0E4E8;">
                    <h4 style="font-weight: 600; font-size: 1.125rem; margin-bottom: 16px; color: #1A1A1A;">Мы в соцсетях</h4>
                    <div class="social-links">
                        <a href="https://vk.com/family.flowers.premium" target="_blank" rel="noopener noreferrer" class="social-icon">
                            <i class="fab fa-vk"></i>
                        </a>
                        <a href="https://max.ru/u/f9LHodD0cOJRZZvr1_tZMFv98PjOK3qOS0jO8cN2E779ngthREV72VUrZTI" target="_blank" rel="noopener noreferrer" class="social-icon" title="MAX">
                            <img src="https://спорина.рф/bitrix/templates/sporina/img/max-messenger.svg" alt="MAX" class="max-icon">
                        </a>
                    </div>
                    <p style="color: #888888; font-size: 0.75rem; margin-top: 12px;">Подписывайтесь на нас!</p>
                </div>
            </div>
        </div>
        
        {{-- Правая колонка: Форма обратной связи --}}
        <div>
            <div style="background: #FFFFFF; border-radius: 24px; padding: clamp(24px, 5vw, 32px); height: 100%; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
                <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 24px; color: #1A1A1A;">Написать нам</h2>
                
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
                
                <form action="{{ route('contacts.send') }}" method="POST" id="contact-form" novalidate>
                    @csrf
                    
                    <div style="margin-bottom: 20px;">
                        <label for="name" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Ваше имя <span style="color: #D26F8B;">*</span></label>
                        <input type="text" name="name" id="name" required value="{{ old('name') }}"
                               style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s; outline: none;"
                               placeholder="Иван Иванов">
                        <div class="error-message" id="name-error" style="color: #E53935; font-size: 0.75rem; margin-top: 5px; display: none;"></div>
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label for="email" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Email <span style="color: #D26F8B;">*</span></label>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}"
                               style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s; outline: none;"
                               placeholder="ivan@example.com">
                        <div class="error-message" id="email-error" style="color: #E53935; font-size: 0.75rem; margin-top: 5px; display: none;"></div>
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label for="phone" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Телефон</label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                               style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s; outline: none;"
                               placeholder="+7 (900) 123-45-67">
                        <div class="error-message" id="phone-error" style="color: #E53935; font-size: 0.75rem; margin-top: 5px; display: none;"></div>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label for="message" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Сообщение <span style="color: #D26F8B;">*</span></label>
                        <textarea name="message" 
                                id="message" 
                                required
                                rows="4"
                                style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s; outline: none; resize: vertical;"
                                placeholder="Расскажите, что вас интересует...">{{ old('message') }}</textarea>
                        <div class="error-message" id="message-error" style="color: #E53935; font-size: 0.75rem; margin-top: 5px; display: none;"></div>
                    </div> 
                    <!-- Один чекбокс -->
                    <div style="margin-bottom: 24px;">
                        <label class="checkbox-label">
                            <input type="checkbox" name="agreement" id="agreement" required>
                            <span class="checkbox-text">
                                Я соглашаюсь на <a href="{{ route('privacy.agreement') }}" target="_blank">обработку персональных данных</a> 
                                 и принимаю <a href="{{ route('privacy.policy') }}" target="_blank">политику конфиденциальности</a>
                        </label>
                        <div class="error-message" id="agreement-error" style="color: #E53935; font-size: 0.75rem; margin-top: 5px; display: none;"></div>
                    </div>
                    
                    <button type="submit" style="width: 100%; background: #D26F8B; color: #FFFFFF; font-weight: 600; padding: 14px; border-radius: 40px; border: none; cursor: pointer; transition: all 0.3s; font-size: 1rem;">
                        Отправить сообщение
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    {{-- Карта --}}
    <div style="margin-top: 60px;">
        <div style="background: #FFFFFF; border-radius: 24px; overflow: hidden; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
            <div style="padding: 20px 24px; border-bottom: 1px solid #F0E4E8;">
                <h2 style="font-size: 1.25rem; font-weight: bold; color: #1A1A1A;">Как нас найти</h2>
                <p style="color: #888888; font-size: 0.875rem; margin-top: 4px;">г. Курган, 3-й микрорайон, д. 30, ТЦ "Метрополис"</p>
            </div>
            <div class="map-container">
                <iframe 
                    src="https://yandex.ru/map-widget/v1/?ll=65.266836%2C55.462676&z=18&pt=65.266836%2C55.462676&l=map"
                    width="100%" 
                    height="100%" 
                    frameborder="0"
                    allowfullscreen="true"
                    style="filter: grayscale(100%); transition: filter 0.5s;">
                </iframe>
            </div>
            <div style="padding: 16px 24px; background: #FAF8F9; text-align: center;">
                <p style="color: #D26F8B; font-weight: 600; margin-bottom: 6px;">📍 Адрес магазина</p>
                <p style="color: #666666; font-size: 0.875rem;">
                    г. Курган, 3-й микрорайон, д. 30<br>
                    ТЦ "Метрополис", цокольный этаж<br>
                    Ориентир: у кинотеатра "Современник", напротив касс супермаркета "Метрополис"
                </p>
                <p style="color: #888888; font-size: 0.75rem; margin-top: 8px;">
                    🚶 Остановка "Культурный центр Современник" — 1 минута пешком
                </p>
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
    
    .contacts-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
    }
    
    .contact-item {
        display: flex;
        gap: 16px;
    }
    
    .contact-icon {
        width: 48px;
        height: 48px;
        background: rgba(210, 111, 139, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .contact-link {
        color: #4A4A4A;
        text-decoration: none;
        font-size: 1.125rem;
        transition: color 0.3s;
    }
    
    .contact-link:hover {
        color: #D26F8B;
    }
    
    /* Социальные сети - БЕЗ БЕЛОГО ФОНА */
    .social-links {
        display: flex;
        gap: 16px;
        justify-content: flex-start;
        flex-wrap: wrap;
    }
    
    .social-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
        text-decoration: none;
        background: transparent;
    }
    
    .social-icon i {
        color: #888888;
        font-size: 1.5rem;
        transition: color 0.3s;
    }
    
    .max-icon {
        width: 24px;
        height: 24px;
        filter: brightness(0) saturate(100%) invert(55%) sepia(0%) saturate(0%);
        transition: all 0.3s;
    }
    
    .social-icon:hover {
        transform: translateY(-3px);
    }
    
    .social-icon:hover i {
        color: #D26F8B;
    }
    
    .social-icon:hover .max-icon {
        filter: brightness(0) saturate(100%) invert(41%) sepia(54%) saturate(1008%) hue-rotate(300deg) brightness(94%) contrast(89%);
    }
    
    /* Чекбокс */
    .checkbox-label {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        cursor: pointer;
    }
    
    .checkbox-label input {
        width: 18px;
        height: 18px;
        margin-top: 2px;
        cursor: pointer;
        accent-color: #D26F8B;
        flex-shrink: 0;
    }
    
    .checkbox-text {
        color: #666666;
        font-size: 0.8rem;
        line-height: 1.4;
    }
    
    .policy-link {
        color: #D26F8B;
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .policy-link:hover {
        text-decoration: underline;
        color: #E89BB3;
    }
    
    .map-container {
        aspect-ratio: 16 / 7;
        background: #F5F0F2;
    }
    
    iframe:hover {
        filter: grayscale(0%) !important;
    }
    
    /* Стили для полей формы */
    input:focus, textarea:focus {
        border-color: #D26F8B !important;
        box-shadow: 0 0 0 3px rgba(210, 111, 139, 0.15) !important;
    }
    
    button:hover {
        background: #E89BB3 !important;
        transform: translateY(-2px);
    }
    
    a[href="tel:+79630101012"]:hover,
    a[href="mailto:family.flowers@mail.ru"]:hover {
        color: #D26F8B !important;
    }
    
    .error-message {
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-5px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .input-error {
        border-color: #E53935 !important;
        background-color: #FFF5F5 !important;
    }
    
    /* Адаптивность */
    @media (max-width: 1024px) {
        .container {
            padding: 0 20px;
        }
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 0 16px;
        }
        
        .contacts-grid {
            grid-template-columns: 1fr;
            gap: 32px;
        }
        
        .map-container {
            aspect-ratio: 4 / 3;
        }
        
        .contact-item {
            flex-direction: column;
            text-align: center;
        }
        
        .contact-icon {
            margin: 0 auto;
        }
        
        .social-links {
            justify-content: center;
        }
        
        .checkbox-label {
            align-items: flex-start;
        }
    }
    
    @media (max-width: 480px) {
        .container {
            padding: 0 12px;
        }
        
        .checkbox-text {
            font-size: 0.7rem;
        }
    }
    /* Стили для ссылок на политику конфиденциальности и согласие */
.checkbox-text .policy-link,
.privacy-links a,
.policy-link {
    color: #D26F8B !important;
    text-decoration: none !important;
    transition: all 0.3s ease !important;
    font-weight: 500 !important;
}

.checkbox-text .policy-link:hover,
.privacy-links a:hover,
.policy-link:hover {
    color: #E89BB3 !important;
    text-decoration: underline !important;
}

/* Также для любых других ссылок на этих страницах */
a[href*="privacy-policy"],
a[href*="privacy-agreement"] {
    color: #D26F8B !important;
    text-decoration: none !important;
}

a[href*="privacy-policy"]:hover,
a[href*="privacy-agreement"]:hover {
    color: #E89BB3 !important;
    text-decoration: underline !important;
}
</style>

<script>
    const errorMessages = {
        required: {
            name: 'Пожалуйста, укажите ваше имя',
            email: 'Пожалуйста, укажите ваш email',
            agreement: 'Необходимо согласие на обработку персональных данных и принятие политики конфиденциальности'
        },
        pattern: {
            email: 'Введите корректный email адрес (например: name@mail.ru)'
        }
    };
    
    function validateField(field) {
        const value = field.value.trim();
        const fieldName = field.id;
        let error = '';
        
        if (field.hasAttribute('required') && !value) {
            error = errorMessages.required[fieldName] || 'Пожалуйста, заполните это поле';
        }
        
        if (fieldName === 'email' && value && !error) {
            const emailRegex = /^[^\s@]+@([^\s@.,]+\.)+[^\s@.,]{2,}$/;
            if (!emailRegex.test(value)) {
                error = errorMessages.pattern.email;
            }
        }
        
        return error;
    }
    
    function showFieldError(field, error) {
        const errorDiv = document.getElementById(`${field.id}-error`);
        if (errorDiv) {
            if (error) {
                errorDiv.textContent = `❌ ${error}`;
                errorDiv.style.display = 'block';
                field.classList.add('input-error');
            } else {
                errorDiv.style.display = 'none';
                errorDiv.textContent = '';
                field.classList.remove('input-error');
            }
        }
    }
    
    function validateForm() {
        let isValid = true;
        const errors = {};
        
        // Валидация имени
        const nameField = document.getElementById('name');
        if (nameField) {
            const nameError = validateField(nameField);
            showFieldError(nameField, nameError);
            if (nameError) {
                errors.name = nameError;
                isValid = false;
            }
        }
        
        // Валидация email
        const emailField = document.getElementById('email');
        if (emailField) {
            const emailError = validateField(emailField);
            showFieldError(emailField, emailError);
            if (emailError) {
                errors.email = emailError;
                isValid = false;
            }
        }
        
        // Валидация телефона (необязательное поле - только проверка формата если заполнено)
        const phoneField = document.getElementById('phone');
        if (phoneField && phoneField.value.trim()) {
            const phoneDigits = phoneField.value.replace(/\D/g, '');
            if (phoneDigits.length !== 11) {
                const phoneError = 'Введите корректный номер телефона (11 цифр)';
                showFieldError(phoneField, phoneError);
                errors.phone = phoneError;
                isValid = false;
            } else {
                showFieldError(phoneField, '');
            }
        }
        
        // Валидация сообщения - НЕ обязательное поле, не проверяем
        
        // Валидация чекбокса
        const agreementCheckbox = document.getElementById('agreement');
        if (agreementCheckbox && !agreementCheckbox.checked) {
            const agreementError = errorMessages.required.agreement;
            showFieldError(agreementCheckbox, agreementError);
            errors.agreement = agreementError;
            isValid = false;
        } else if (agreementCheckbox) {
            showFieldError(agreementCheckbox, '');
        }
        
        // Показываем общий блок ошибок
        const errorsContainer = document.getElementById('validation-errors');
        const errorsList = document.getElementById('errors-list');
        
        if (!isValid) {
            const errorMessagesList = Object.values(errors);
            errorsList.innerHTML = errorMessagesList.map(msg => 
                `<p style="color: #E53935; font-size: 0.875rem; margin-bottom: 5px;">❌ ${msg}</p>`
            ).join('');
            errorsContainer.style.display = 'block';
            
            // Прокручиваем к первому полю с ошибкой
            const firstErrorField = document.querySelector('.input-error');
            if (firstErrorField) {
                firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstErrorField.focus();
            }
            
            return false;
        } else {
            errorsContainer.style.display = 'none';
            errorsList.innerHTML = '';
            return true;
        }
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contact-form');
        
        if (form) {
            form.setAttribute('novalidate', true);
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (validateForm()) {
                    this.submit();
                }
            });
        }
        
        // Live-валидация при вводе
        const nameField = document.getElementById('name');
        const emailField = document.getElementById('email');
        const phoneField = document.getElementById('phone');
        const agreementCheckbox = document.getElementById('agreement');
        
        if (nameField) {
            nameField.addEventListener('input', function() {
                const error = validateField(this);
                showFieldError(this, error);
                if (!error) {
                    const errorsContainer = document.getElementById('validation-errors');
                    if (errorsContainer) errorsContainer.style.display = 'none';
                }
            });
            nameField.addEventListener('blur', function() {
                const error = validateField(this);
                showFieldError(this, error);
            });
        }
        
        if (emailField) {
            emailField.addEventListener('input', function() {
                const error = validateField(this);
                showFieldError(this, error);
                if (!error) {
                    const errorsContainer = document.getElementById('validation-errors');
                    if (errorsContainer) errorsContainer.style.display = 'none';
                }
            });
            emailField.addEventListener('blur', function() {
                const error = validateField(this);
                showFieldError(this, error);
            });
        }
        
        if (phoneField) {
            phoneField.addEventListener('input', function() {
                let digits = this.value.replace(/\D/g, '');
                if (digits.length > 11) digits = digits.slice(0, 11);
                if (digits[0] === '8') digits = '7' + digits.slice(1);
                
                let formatted = '';
                if (digits.length > 0) {
                    formatted = '+7';
                    if (digits.length > 1) formatted += ' (' + digits.slice(1, 4);
                    if (digits.length > 4) formatted += ') ' + digits.slice(4, 7);
                    if (digits.length > 7) formatted += '-' + digits.slice(7, 9);
                    if (digits.length > 9) formatted += '-' + digits.slice(9, 11);
                }
                this.value = formatted;
                
                const error = (this.value.trim() && this.value.replace(/\D/g, '').length !== 11) ? 'Введите корректный номер телефона (11 цифр)' : '';
                showFieldError(this, error);
                if (!error) {
                    const errorsContainer = document.getElementById('validation-errors');
                    if (errorsContainer) errorsContainer.style.display = 'none';
                }
            });
        }
        
        if (agreementCheckbox) {
            agreementCheckbox.addEventListener('change', function() {
                const error = this.checked ? '' : errorMessages.required.agreement;
                showFieldError(this, error);
                if (this.checked) {
                    const errorsContainer = document.getElementById('validation-errors');
                    if (errorsContainer) errorsContainer.style.display = 'none';
                }
            });
        }
    });
</script>
@endsection