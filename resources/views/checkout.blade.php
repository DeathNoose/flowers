@extends('layouts.app')

@section('title', 'Оформление заказа')

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    <h1 style="font-size: 2.5rem; font-weight: bold; margin-bottom: 40px; color: #1A1A1A;">Оформление заказа</h1>
    
    <div style="display: grid; grid-template-columns: 1fr; gap: 40px; lg:grid-template-columns: 2fr 1fr;">
        <div>
            <div style="background: #FFFFFF; border-radius: 24px; padding: 32px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
                <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 24px; color: #1A1A1A;">Контактные данные</h2>
                
                <form action="{{ route('order.store') }}" method="POST" id="order-form">
                    @csrf
                    <div style="display: flex; flex-direction: column; gap: 20px;">
                        <div>
                            <label for="customer_name" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">
                                Ваше имя <span style="color: #D26F8B;">*</span>
                            </label>
                            <input type="text" 
                                   name="customer_name" 
                                   id="customer_name" 
                                   required
                                   value="{{ old('customer_name') }}"
                                   style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s; outline: none;"
                                   placeholder="Иван Иванов">
                            @error('customer_name')
                                <p style="color: #E53935; font-size: 0.875rem; margin-top: 4px;">{{ $message }}</p>
                            @enderror
                            <p style="color: #888888; font-size: 0.75rem; margin-top: 4px;">Только буквы, пробелы и дефисы</p>
                        </div>
                        
                        <div>
                            <label for="phone" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">
                                Телефон <span style="color: #D26F8B;">*</span>
                            </label>
                            <input type="tel" 
                                   name="phone" 
                                   id="phone" 
                                   required
                                   value="{{ old('phone') }}"
                                   style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s; outline: none;"
                                   placeholder="+7 (999) 123-45-67">
                            @error('phone')
                                <p style="color: #E53935; font-size: 0.875rem; margin-top: 4px;">{{ $message }}</p>
                            @enderror
                            <p style="color: #888888; font-size: 0.75rem; margin-top: 4px;">Формат: +7 (999) 123-45-67 (10 цифр)</p>
                        </div>
                        
                        <div>
                            <label for="address" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">
                                Адрес доставки <span style="color: #D26F8B;">*</span>
                            </label>
                            <textarea name="address" 
                                      id="address" 
                                      required
                                      rows="3"
                                      style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s; outline: none; resize: vertical;"
                                      placeholder="г. Курган, 3-й микрорайон, д. 30, ТЦ Метрополис, цокольный этаж">{{ old('address') }}</textarea>
                            @error('address')
                                <p style="color: #E53935; font-size: 0.875rem; margin-top: 4px;">{{ $message }}</p>
                            @enderror
                            <p style="color: #888888; font-size: 0.75rem; margin-top: 4px;">Укажите полный адрес с номером дома и квартиры</p>
                        </div>
                        
                        <div>
                            <label for="comment" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Комментарий к заказу</label>
                            <textarea name="comment" 
                                      id="comment" 
                                      rows="3"
                                      style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s; outline: none; resize: vertical;"
                                      placeholder="Пожелания по доставке, составу букета и т.д.">{{ old('comment') }}</textarea>
                            @error('comment')
                                <p style="color: #E53935; font-size: 0.875rem; margin-top: 4px;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div>
            <div style="background: #FFFFFF; border-radius: 24px; padding: 32px; position: sticky; top: 100px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
                <h3 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 20px; color: #1A1A1A;">Ваш заказ</h3>
                
                <div style="margin-bottom: 24px; max-height: 300px; overflow-y: auto;">
                    @foreach($items as $item)
                    <div style="display: flex; justify-content: space-between; margin-bottom: 12px; padding-bottom: 12px; border-bottom: 1px solid #F0E4E8;">
                        <span style="color: #4A4A4A;">{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                        <span style="color: #D26F8B; font-weight: 600;">{{ number_format($item['total'], 0, ',', ' ') }} ₽</span>
                    </div>
                    @endforeach
                </div>
                
                <div style="border-top: 1px solid #F0E4E8; padding-top: 16px; margin-bottom: 24px;">
                    <div style="display: flex; justify-content: space-between; font-size: 1.25rem; font-weight: bold;">
                        <span style="color: #1A1A1A;">Итого:</span>
                        <span id="order-total" style="color: #D26F8B;">{{ number_format($total, 0, ',', ' ') }} ₽</span>
                    </div>
                </div>
                
               <button type="submit" form="order-form" id="submit-btn" style="width: 100%; background: #D26F8B; color: #FFFFFF; font-weight: 600; padding: 14px 24px; border-radius: 40px; border: none; cursor: pointer; transition: all 0.3s;">
    <span id="btn-text">Подтвердить заказ</span>
    <span id="btn-loader" style="display: none;">
        <svg style="width: 20px; height: 20px; animation: spin 1s linear infinite; margin: 0 auto;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 12a9 9 0 1 1-6.219-8.56" stroke-linecap="round"/>
        </svg>
    </span>
</button>

<style>
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>
                
                <p style="font-size: 0.75rem; color: #888888; text-align: center; margin-top: 16px;">
                    Нажимая «Подтвердить заказ», вы соглашаетесь с условиями обработки персональных данных
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
    
    @media (max-width: 1024px) {
        .container {
            padding: 0 20px;
        }
        [style*="grid-template-columns: 1fr; lg:grid-template-columns: 2fr 1fr;"] {
            grid-template-columns: 1fr !important;
        }
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 0 16px;
        }
        h1 {
            font-size: 1.75rem !important;
        }
    }
    
    input:focus, textarea:focus {
        border-color: #D26F8B !important;
        box-shadow: 0 0 0 3px rgba(210, 111, 139, 0.15) !important;
    }
    
    button:hover {
        background: #E89BB3 !important;
        transform: translateY(-2px);
    }
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('order-form');
    const nameInput = document.getElementById('customer_name');
    const phoneInput = document.getElementById('phone');
    const addressInput = document.getElementById('address');
    
    // Функция валидации имени
    function validateName(name) {
        const nameRegex = /^[а-яА-ЯёЁa-zA-Z\s\-]+$/;
        if (!name.trim()) {
            return 'Пожалуйста, укажите ваше имя';
        }
        if (!nameRegex.test(name)) {
            return 'Имя может содержать только буквы, пробелы и дефисы';
        }
        if (name.length > 255) {
            return 'Имя не должно превышать 255 символов';
        }
        return null;
    }
    
    // Функция получения количества цифр в номере
    function getPhoneDigits(phone) {
        return phone.replace(/\D/g, '');
    }
    
    // Функция валидации телефона
    function validatePhone(phone) {
        const cleanPhone = getPhoneDigits(phone);
        const digitCount = cleanPhone.length;
        
        if (!phone.trim()) {
            return 'Пожалуйста, укажите номер телефона';
        }
        
        if (digitCount < 10) {
            return `Номер телефона должен содержать 10 цифр (сейчас ${digitCount})`;
        }
        
        if (digitCount > 11) {
            return `Номер телефона не должен содержать более 11 цифр (сейчас ${digitCount})`;
        }
        
        const firstDigit = cleanPhone[0];
        if (firstDigit !== '7' && firstDigit !== '8') {
            return 'Номер телефона должен начинаться с 7 или 8';
        }
        
        const phoneRegex = /^\+7\s?\(?[0-9]{3}\)?\s?[0-9]{3}-?[0-9]{2}-?[0-9]{2}$/;
        if (!phoneRegex.test(phone) && cleanPhone.length === 11) {
            return 'Введите номер в формате +7 (999) 123-45-67';
        }
        
        return null;
    }
    
    // Функция валидации адреса
    function validateAddress(address) {
        if (!address.trim()) {
            return 'Пожалуйста, укажите адрес доставки';
        }
        if (address.length > 500) {
            return 'Адрес не должен превышать 500 символов';
        }
        if (address.length < 10) {
            return 'Пожалуйста, укажите полный адрес (улица, дом, квартира)';
        }
        return null;
    }
    
    // Функция отображения ошибки
    function showError(input, message) {
        const existingError = input.parentElement.querySelector('.error-message');
        if (existingError) {
            existingError.remove();
        }
        input.style.borderColor = '#E53935';
        const errorDiv = document.createElement('p');
        errorDiv.className = 'error-message';
        errorDiv.style.cssText = 'color: #E53935; font-size: 0.875rem; margin-top: 4px;';
        errorDiv.textContent = message;
        input.parentElement.appendChild(errorDiv);
    }
    
    // Функция очистки ошибки
    function clearError(input) {
        input.style.borderColor = '#F0E4E8';
        const errorDiv = input.parentElement.querySelector('.error-message');
        if (errorDiv) {
            errorDiv.remove();
        }
    }
    
    // Форматирование номера телефона
    function formatPhoneNumber(value) {
        let digits = value.replace(/\D/g, '');
        
        if (digits.length > 11) {
            digits = digits.slice(0, 11);
        }
        
        if (digits.length > 0 && digits[0] === '8') {
            digits = '7' + digits.slice(1);
        }
        
        let formatted = '';
        
        if (digits.length > 0) {
            formatted = '+7';
            
            if (digits.length > 1) {
                formatted += ' (' + digits.slice(1, 4);
            }
            if (digits.length > 4) {
                formatted += ') ' + digits.slice(4, 7);
            }
            if (digits.length > 7) {
                formatted += '-' + digits.slice(7, 9);
            }
            if (digits.length > 9) {
                formatted += '-' + digits.slice(9, 11);
            }
        }
        
        return formatted;
    }
    
    // Валидация в реальном времени
    if (nameInput) {
        nameInput.addEventListener('input', function() {
            const error = validateName(this.value);
            if (error) {
                showError(this, error);
            } else {
                clearError(this);
            }
        });
    }
    
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            const formatted = formatPhoneNumber(this.value);
            if (formatted !== this.value) {
                this.value = formatted;
            }
            
            const error = validatePhone(this.value);
            if (error) {
                showError(this, error);
            } else {
                clearError(this);
            }
        });
        
        phoneInput.addEventListener('blur', function() {
            const digits = getPhoneDigits(this.value);
            if (digits.length === 10) {
                this.value = '+7 (' + digits.slice(0, 3) + ') ' + 
                             digits.slice(3, 6) + '-' + 
                             digits.slice(6, 8) + '-' + 
                             digits.slice(8, 10);
            } else if (digits.length === 11 && digits[0] === '7') {
                this.value = '+7 (' + digits.slice(1, 4) + ') ' + 
                             digits.slice(4, 7) + '-' + 
                             digits.slice(7, 9) + '-' + 
                             digits.slice(9, 11);
            }
            
            const error = validatePhone(this.value);
            if (error) {
                showError(this, error);
            } else {
                clearError(this);
            }
        });
    }
    
    if (addressInput) {
        addressInput.addEventListener('input', function() {
            const error = validateAddress(this.value);
            if (error) {
                showError(this, error);
            } else {
                clearError(this);
            }
        });
    }
    
    // Валидация перед отправкой
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        const nameError = validateName(nameInput.value);
        if (nameError) {
            showError(nameInput, nameError);
            isValid = false;
        }
        
        const phoneError = validatePhone(phoneInput.value);
        if (phoneError) {
            showError(phoneInput, phoneError);
            isValid = false;
        }
        
        const addressError = validateAddress(addressInput.value);
        if (addressError) {
            showError(addressInput, addressError);
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
            const firstError = document.querySelector('[style*="border-color: #E53935"]');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });
    
    // Запрещаем ввод букв в поле телефона
    if (phoneInput) {
        phoneInput.addEventListener('keydown', function(e) {
            const allowedKeys = ['Backspace', 'Delete', 'Tab', 'Escape', 'Enter', 'ArrowLeft', 'ArrowRight', 'ArrowUp', 'ArrowDown', 'Home', 'End'];
            if (allowedKeys.includes(e.key)) {
                return;
            }
            if (!/^[\d\+\(\)\-\s]$/.test(e.key)) {
                e.preventDefault();
            }
        });
    }
    // Индикатор загрузки при отправке формы
const submitBtn = document.getElementById('submit-btn');
const btnText = document.getElementById('btn-text');
const btnLoader = document.getElementById('btn-loader');

form.addEventListener('submit', function(e) {
    let isValid = true;
    
    const nameError = validateName(nameInput.value);
    if (nameError) {
        showError(nameInput, nameError);
        isValid = false;
    }
    
    const phoneError = validatePhone(phoneInput.value);
    if (phoneError) {
        showError(phoneInput, phoneError);
        isValid = false;
    }
    
    const addressError = validateAddress(addressInput.value);
    if (addressError) {
        showError(addressInput, addressError);
        isValid = false;
    }
    
    if (!isValid) {
        e.preventDefault();
        const firstError = document.querySelector('[style*="border-color: #E53935"]');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    } else {
        // Показываем индикатор загрузки
        btnText.style.display = 'none';
        btnLoader.style.display = 'inline-block';
        submitBtn.disabled = true;
        submitBtn.style.opacity = '0.7';
    }
});
});
</script>
@endpush
@endsection