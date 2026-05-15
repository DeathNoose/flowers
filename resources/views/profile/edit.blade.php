@extends('layouts.app')

@section('title', 'Редактирование профиля')

@section('content')
<div class="container" style="padding: 80px 0;">
    <div style="max-width: 600px; margin: 0 auto;">
        <div style="background: #FFFFFF; border-radius: 24px; padding: 40px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
            <h1 style="font-size: 2rem; font-weight: bold; margin-bottom: 32px; text-align: center; color: #1A1A1A;">Редактирование профиля</h1>
            
            @if(session('success'))
                <div style="background: rgba(210, 111, 139, 0.1); border: 1px solid #D26F8B; border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                    <p style="color: #D26F8B;">{{ session('success') }}</p>
                </div>
            @endif
            
            @if($errors->any())
                <div style="background: rgba(229, 57, 53, 0.1); border: 1px solid #E53935; border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                    @foreach($errors->all() as $error)
                        <p style="color: #E53935; font-size: 0.875rem;">{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
                
                <div style="margin-bottom: 20px;">
                    <label for="name" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Имя *</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;">
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="email" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Email</label>
                    <input type="email" id="email" value="{{ $user->email }}" disabled
                           style="width: 100%; background: #F0E4E8; border: 1px solid #E8D0D8; border-radius: 12px; padding: 12px 16px; color: #888888; cursor: not-allowed;">
                    <p style="color: #888888; font-size: 0.75rem; margin-top: 4px;">Email нельзя изменить</p>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="phone" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Телефон *</label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" required
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;"
                           placeholder="+7 (999) 123-45-67">
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="address" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Адрес</label>
                    <textarea name="address" id="address" rows="3"
                              style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s; resize: vertical;"
                              placeholder="г. Курган, 3-й микрорайон, д. 30, кв. 1">{{ old('address', $user->address) }}</textarea>
                </div>
                
                <div style="border-top: 1px solid #F0E4E8; margin: 24px 0; padding-top: 24px;">
                    <h3 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 20px; color: #1A1A1A;">Смена пароля</h3>
                    
                    <div style="margin-bottom: 20px;">
                        <label for="current_password" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Текущий пароль</label>
                        <input type="password" name="current_password" id="current_password"
                               style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;">
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label for="new_password" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Новый пароль</label>
                        <input type="password" name="new_password" id="new_password"
                               style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;">
                        <p style="color: #888888; font-size: 0.75rem; margin-top: 4px;">Минимум 6 символов</p>
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label for="new_password_confirmation" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Подтверждение пароля</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                               style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;">
                    </div>
                </div>
                
                <div style="display: flex; gap: 16px; margin-top: 24px;">
                    <button type="submit" style="flex: 1; background: #D26F8B; color: #FFFFFF; font-weight: 600; padding: 14px; border-radius: 40px; border: none; cursor: pointer; transition: all 0.3s;">
                        Сохранить изменения
                    </button>
                    <a href="{{ route('profile.index') }}" style="flex: 1; text-align: center; background: #F5F0F2; color: #1A1A1A; font-weight: 600; padding: 14px; border-radius: 40px; text-decoration: none; transition: all 0.3s;">
                        Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    input:focus, textarea:focus {
        border-color: #D26F8B !important;
        outline: none;
        box-shadow: 0 0 0 3px rgba(210, 111, 139, 0.15);
    }
    
    button:hover {
        background: #E89BB3 !important;
        transform: translateY(-2px);
    }
    
    .cancel-btn:hover {
        background: #E8D0D8 !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const phoneInput = document.getElementById('phone');
    
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
    
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            const formatted = formatPhoneNumber(this.value);
            if (formatted !== this.value) {
                this.value = formatted;
            }
        });
        
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
});
</script>
@endsection