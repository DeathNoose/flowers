@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
<div class="container" style="padding: 80px 0;">
    <div style="max-width: 500px; margin: 0 auto;">
        <div style="background: #FFFFFF; border-radius: 24px; padding: 40px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
            <h1 style="font-size: 2rem; font-weight: bold; margin-bottom: 32px; text-align: center; color: #1A1A1A;">Регистрация</h1>
            
            @if($errors->any())
                <div style="background: rgba(229, 57, 53, 0.1); border: 1px solid #E53935; border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                    @foreach($errors->all() as $error)
                        <p style="color: #E53935; font-size: 0.875rem;">{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div style="margin-bottom: 20px;">
                    <label for="name" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Имя *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;">
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="email" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Email *</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;">
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="phone" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Телефон *</label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;"
                           placeholder="+7 (999) 123-45-67">
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="password" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Пароль *</label>
                    <input type="password" name="password" id="password" required
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;">
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="password_confirmation" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Подтверждение пароля *</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;">
                </div>
                
                <!-- Согласие на обработку персональных данных -->
                <div style="margin-bottom: 24px;">
                    <label style="display: flex; align-items: flex-start; gap: 12px; cursor: pointer;">
                        <input type="checkbox" name="privacy_policy" id="privacy_policy" required
                               style="width: 18px; height: 18px; margin-top: 2px; cursor: pointer;">
                        <span style="color: #666666; font-size: 0.8rem; line-height: 1.4;">
                            Я соглашаюсь на 
                            <a href="#" style="color: #D26F8B; text-decoration: none;">обработку персональных данных</a>
                            и принимаю условия 
                            <a href="#" style="color: #D26F8B; text-decoration: none;">пользовательского соглашения</a>
                        </span>
                    </label>
                    @error('privacy_policy')
                        <p style="color: #E53935; font-size: 0.75rem; margin-top: 8px;">{{ $message }}</p>
                    @enderror
                </div>
                
                <button type="submit" style="width: 100%; background: #D26F8B; color: #FFFFFF; font-weight: 600; padding: 14px; border-radius: 40px; border: none; cursor: pointer; transition: all 0.3s;">
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
    
    input:focus {
        border-color: #D26F8B !important;
        outline: none;
        box-shadow: 0 0 0 3px rgba(210, 111, 139, 0.15);
    }
    
    button:hover {
        background: #E89BB3 !important;
        transform: translateY(-2px);
    }
    
    a:hover {
        color: #E89BB3 !important;
    }
</style>

<script>
document.getElementById('phone').addEventListener('input', function(e) {
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
</script>
@endsection