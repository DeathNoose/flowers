@extends('layouts.app')

@section('title', 'Вход')

@section('content')
<div class="container" style="padding: 80px 0;">
    <div style="max-width: 500px; margin: 0 auto; padding: 0 20px;">
        <div style="background: #FFFFFF; border-radius: 24px; padding: clamp(24px, 5vw, 40px); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
            <h1 style="font-size: clamp(1.5rem, 5vw, 2rem); font-weight: bold; margin-bottom: 32px; text-align: center; color: #1A1A1A;">Вход</h1>
            
            <!-- Ошибки валидации -->
            <div id="validation-errors" style="display: none; background: rgba(229, 57, 53, 0.1); border: 1px solid #E53935; border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                <div id="errors-list"></div>
            </div>
            
            @if(session('success'))
                <div style="background: rgba(76, 175, 80, 0.1); border: 1px solid #4CAF50; border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                    <p style="color: #4CAF50; font-size: 0.875rem;">✓ {{ session('success') }}</p>
                </div>
            @endif
            
            @if($errors->any())
                <div style="background: rgba(229, 57, 53, 0.1); border: 1px solid #E53935; border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                    @foreach($errors->all() as $error)
                        <p style="color: #E53935; font-size: 0.875rem;">❌ {{ $error }}</p>
                    @endforeach
                </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}" id="login-form" novalidate>
                @csrf
                
                <div style="margin-bottom: 20px;">
                    <label for="email" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Email *</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;">
                    <div class="error-message" id="email-error" style="color: #E53935; font-size: 0.75rem; margin-top: 5px; display: none;"></div>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="password" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Пароль *</label>
                    <input type="password" name="password" id="password" required
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;">
                    <div class="error-message" id="password-error" style="color: #E53935; font-size: 0.75rem; margin-top: 5px; display: none;"></div>
                </div>
                
                <div style="margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="remember" id="remember" style="width: 16px; height: 16px;">
                        <span style="color: #888888; font-size: 0.875rem;">Запомнить меня</span>
                    </label>
                    
                    <a href="{{ route('password.request') }}" style="color: #D26F8B; text-decoration: none; font-size: 0.875rem; transition: all 0.3s;">
                        Забыли пароль?
                    </a>
                </div>
                
                <button type="submit" style="width: 100%; background: #D26F8B; color: #FFFFFF; font-weight: 600; padding: 14px; border-radius: 40px; border: none; cursor: pointer; transition: all 0.3s; font-size: 1rem;">
                    Войти
                </button>
                
                <p style="text-align: center; margin-top: 20px; color: #888888; font-size: 0.875rem;">
                    Нет аккаунта? 
                    <a href="{{ route('register') }}" style="color: #D26F8B; text-decoration: none;">Зарегистрироваться</a>
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
    }
    
    input:focus {
        border-color: #D26F8B !important;
        outline: none;
        box-shadow: 0 0 0 3px rgba(210, 111, 139, 0.15);
    }
    
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
</style>

<script>
    const errorMessages = {
        required: {
            email: 'Пожалуйста, укажите ваш email',
            password: 'Пожалуйста, введите пароль'
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
        
        const emailField = document.getElementById('email');
        if (emailField) {
            const emailError = validateField(emailField);
            showFieldError(emailField, emailError);
            if (emailError) {
                errors.email = emailError;
                isValid = false;
            }
        }
        
        const passwordField = document.getElementById('password');
        if (passwordField) {
            const passwordError = validateField(passwordField);
            showFieldError(passwordField, passwordError);
            if (passwordError) {
                errors.password = passwordError;
                isValid = false;
            }
        }
        
        const errorsContainer = document.getElementById('validation-errors');
        const errorsList = document.getElementById('errors-list');
        
        if (!isValid) {
            const errorMessagesList = Object.values(errors);
            errorsList.innerHTML = errorMessagesList.map(msg => 
                `<p style="color: #E53935; font-size: 0.875rem; margin-bottom: 5px;">❌ ${msg}</p>`
            ).join('');
            errorsContainer.style.display = 'block';
            
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
        const form = document.getElementById('login-form');
        
        if (form) {
            form.setAttribute('novalidate', true);
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (validateForm()) {
                    this.submit();
                }
            });
        }
        
        const emailField = document.getElementById('email');
        const passwordField = document.getElementById('password');
        
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
        
        if (passwordField) {
            passwordField.addEventListener('input', function() {
                const error = validateField(this);
                showFieldError(this, error);
                if (!error) {
                    const errorsContainer = document.getElementById('validation-errors');
                    if (errorsContainer) errorsContainer.style.display = 'none';
                }
            });
            
            passwordField.addEventListener('blur', function() {
                const error = validateField(this);
                showFieldError(this, error);
            });
        }
    });
</script>
@endsection