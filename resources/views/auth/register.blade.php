@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
<div class="container" style="padding: 80px 0;">
    <div style="max-width: 500px; margin: 0 auto; padding: 0 20px;">
        <div style="background: #FFFFFF; border-radius: 24px; padding: clamp(24px, 5vw, 40px); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
            <h1 style="font-size: clamp(1.5rem, 5vw, 2rem); font-weight: bold; margin-bottom: 32px; text-align: center; color: #1A1A1A;">Регистрация</h1>
            
            <!-- Ошибки валидации -->
            <div id="validation-errors" style="display: none; background: rgba(229, 57, 53, 0.1); border: 1px solid #E53935; border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                <div id="errors-list"></div>
            </div>
            
            <form method="POST" action="{{ route('register') }}" id="register-form" novalidate>
                @csrf
                
                <div style="margin-bottom: 20px;">
                    <label for="name" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Имя *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;">
                    <div class="error-message" id="name-error" style="color: #E53935; font-size: 0.75rem; margin-top: 5px; display: none;"></div>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="email" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Email *</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;">
                    <div class="error-message" id="email-error" style="color: #E53935; font-size: 0.75rem; margin-top: 5px; display: none;"></div>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="phone" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Телефон *</label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;"
                           placeholder="+7 (999) 123-45-67">
                    <div class="error-message" id="phone-error" style="color: #E53935; font-size: 0.75rem; margin-top: 5px; display: none;"></div>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="password" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Пароль *</label>
                    <input type="password" name="password" id="password" required
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;">
                    <div class="error-message" id="password-error" style="color: #E53935; font-size: 0.75rem; margin-top: 5px; display: none;"></div>
                    <div style="font-size: 0.7rem; color: #888888; margin-top: 5px;">Минимум 6 символов</div>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="password_confirmation" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Подтверждение пароля *</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;">
                    <div class="error-message" id="password_confirmation-error" style="color: #E53935; font-size: 0.75rem; margin-top: 5px; display: none;"></div>
                </div>
                
                <!-- Согласие на обработку персональных данных -->
                <div style="margin-bottom: 24px;">
                    <label style="display: flex; align-items: flex-start; gap: 12px; cursor: pointer;">
                        <input type="checkbox" name="privacy_policy" id="privacy_policy" required
                               style="width: 18px; height: 18px; margin-top: 2px; cursor: pointer;">
        <span class="checkbox-text">
            Я соглашаюсь на <a href="{{ route('privacy.agreement') }}" target="_blank">обработку персональных данных</a> 
            и принимаю <a href="{{ route('privacy.policy') }}" target="_blank">политику конфиденциальности</a>
        </span>
                    </label>
                    <div class="error-message" id="privacy_policy-error" style="color: #E53935; font-size: 0.75rem; margin-top: 5px; display: none;"></div>
                </div>
                
                <button type="submit" style="width: 100%; background: #D26F8B; color: #FFFFFF; font-weight: 600; padding: 14px; border-radius: 40px; border: none; cursor: pointer; transition: all 0.3s; font-size: 1rem;">
                    Зарегистрироваться
                </button>
                
                <p style="text-align: center; margin-top: 20px; color: #888888; font-size: 0.875rem;">
                    Уже есть аккаунт? 
                    <a href="{{ route('login') }}" style="color: #D26F8B; text-decoration: none;">Войти</a>
                </p>
            </form>
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
    
    @media (max-width: 768px) {
        .container {
            padding: 0 20px;
        }
    }
    
    @media (max-width: 480px) {
        .container {
            padding: 0 15px;
        }
        
        [style*="max-width: 500px"] {
            padding: 0 !important;
        }
    }
    
    input:focus {
        border-color: #D26F8B !important;
        outline: none;
        box-shadow: 0 0 0 3px rgba(210, 111, 139, 0.15);
    }
    
    /* Стиль для полей с ошибкой */
    .input-error {
        border-color: #E53935 !important;
        background-color: #FFF5F5 !important;
    }
    
    button:hover {
        background: #E89BB3 !important;
        transform: translateY(-2px);
    }
    
    a:hover {
        color: #E89BB3 !important;
    }
    
    /* Анимация ошибок */
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
    // Русские сообщения об ошибках
    const errorMessages = {
        required: {
            name: 'Пожалуйста, укажите ваше имя',
            email: 'Пожалуйста, укажите ваш email',
            phone: 'Пожалуйста, укажите номер телефона',
            password: 'Пожалуйста, придумайте пароль',
            password_confirmation: 'Пожалуйста, подтвердите пароль',
            privacy_policy: 'Пожалуйста, согласитесь с условиями'
        },
        pattern: {
            email: 'Введите корректный email адрес (например: name@mail.ru)',
            phone: 'Введите корректный номер телефона (11 цифр)'
        },
        minlength: {
            name: 'Имя должно содержать минимум 2 символа',
            password: 'Пароль должен содержать минимум 6 символов'
        },
        maxlength: {
            name: 'Имя не должно превышать 50 символов',
            password: 'Пароль не должен превышать 50 символов'
        },
        match: {
            password_confirmation: 'Пароли не совпадают'
        }
    };
    
    // Функция валидации поля
    function validateField(field) {
        const value = field.value.trim();
        const fieldName = field.id;
        let error = '';
        
        // Проверка на required
        if (field.hasAttribute('required') && !value) {
            error = errorMessages.required[fieldName] || 'Пожалуйста, заполните это поле';
        }
        
        // Проверка email
        if (fieldName === 'email' && value && !error) {
            const emailRegex = /^[^\s@]+@([^\s@.,]+\.)+[^\s@.,]{2,}$/;
            if (!emailRegex.test(value)) {
                error = errorMessages.pattern.email;
            }
        }
        
        // Проверка телефона
        if (fieldName === 'phone' && value && !error) {
            const phoneDigits = value.replace(/\D/g, '');
            if (phoneDigits.length !== 11) {
                error = errorMessages.pattern.phone;
            } else if (phoneDigits[0] !== '7' && phoneDigits[0] !== '8') {
                error = 'Номер должен начинаться с 7 или 8';
            }
        }
        
        // Проверка минимальной длины
        if (fieldName === 'name' && value && !error && value.length < 2) {
            error = errorMessages.minlength.name;
        }
        
        if (fieldName === 'password' && value && !error && value.length < 6) {
            error = errorMessages.minlength.password;
        }
        
        // Проверка максимальной длины
        if (fieldName === 'name' && value && !error && value.length > 50) {
            error = errorMessages.maxlength.name;
        }
        
        if (fieldName === 'password' && value && !error && value.length > 50) {
            error = errorMessages.maxlength.password;
        }
        
        // Проверка совпадения паролей
        if (fieldName === 'password_confirmation' && value && !error) {
            const password = document.getElementById('password').value;
            if (password !== value) {
                error = errorMessages.match.password_confirmation;
            }
        }
        
        return error;
    }
    
    // Функция отображения ошибки для поля
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
    
    // Функция валидации всей формы
    function validateForm() {
        let isValid = true;
        const errors = {};
        const fields = ['name', 'email', 'phone', 'password', 'password_confirmation', 'privacy_policy'];
        
        // Валидация текстовых полей
        fields.forEach(fieldName => {
            if (fieldName === 'privacy_policy') {
                const checkbox = document.getElementById(fieldName);
                if (checkbox && checkbox.hasAttribute('required') && !checkbox.checked) {
                    errors[fieldName] = 'Пожалуйста, подтвердите согласие на обработку персональных данных';
                    isValid = false;
                    showFieldError(checkbox, errors[fieldName]);
                } else if (checkbox) {
                    showFieldError(checkbox, '');
                }
                return;
            }
            
            const field = document.getElementById(fieldName);
            if (field) {
                const error = validateField(field);
                showFieldError(field, error);
                if (error) {
                    errors[fieldName] = error;
                    isValid = false;
                }
            }
        });
        
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
            
            // Показываем всплывающее уведомление
            if (typeof Toast !== 'undefined') {
                Toast.show('Пожалуйста, исправьте ошибки в форме', 'error');
            }
        } else {
            errorsContainer.style.display = 'none';
            errorsList.innerHTML = '';
        }
        
        return isValid;
    }
    
    // Обработчик отправки формы
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('register-form');
        const phoneInput = document.getElementById('phone');
        
        // Отключаем стандартную браузерную валидацию
        form.setAttribute('novalidate', true);
        
        // Обработка отправки формы
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (validateForm()) {
                this.submit();
            }
        });
        
        // Live-валидация при вводе
        const fields = ['name', 'email', 'phone', 'password', 'password_confirmation'];
        fields.forEach(fieldName => {
            const field = document.getElementById(fieldName);
            if (field) {
                field.addEventListener('input', function() {
                    const error = validateField(this);
                    showFieldError(this, error);
                    
                    // Скрываем общий контейнер ошибок при исправлении
                    if (!error) {
                        const errorsContainer = document.getElementById('validation-errors');
                        if (errorsContainer) {
                            errorsContainer.style.display = 'none';
                        }
                    }
                });
                
                field.addEventListener('blur', function() {
                    const error = validateField(this);
                    showFieldError(this, error);
                });
            }
        });
        
        // Валидация чекбокса
        const privacyCheckbox = document.getElementById('privacy_policy');
        if (privacyCheckbox) {
            privacyCheckbox.addEventListener('change', function() {
                const error = this.checked ? '' : 'Пожалуйста, подтвердите согласие на обработку персональных данных';
                showFieldError(this, error);
                
                if (this.checked) {
                    const errorsContainer = document.getElementById('validation-errors');
                    if (errorsContainer) {
                        errorsContainer.style.display = 'none';
                    }
                }
            });
        }
        
        // Форматирование телефона
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
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
            });
        }
    });
</script>
@endsection