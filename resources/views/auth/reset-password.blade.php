@extends('layouts.app')

@section('title', 'Сброс пароля')

@section('content')
<div class="container" style="padding: 80px 0;">
    <div style="max-width: 500px; margin: 0 auto; padding: 0 20px;">
        <div style="background: #FFFFFF; border-radius: 24px; padding: clamp(24px, 5vw, 40px); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
            <h1 style="font-size: clamp(1.5rem, 5vw, 2rem); font-weight: bold; margin-bottom: 16px; text-align: center; color: #1A1A1A;">Сброс пароля</h1>
            <p style="text-align: center; color: #888888; margin-bottom: 32px; font-size: 0.875rem;">
                Придумайте новый пароль для вашего аккаунта
            </p>
            
            @if($errors->any())
                <div style="background: rgba(229, 57, 53, 0.1); border: 1px solid #E53935; border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                    @foreach($errors->all() as $error)
                        <p style="color: #E53935; font-size: 0.875rem;">❌ {{ $error }}</p>
                    @endforeach
                </div>
            @endif
            
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                
                <div style="margin-bottom: 20px;">
                    <label for="email" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Email *</label>
                    <input type="email" name="email" id="email" value="{{ $email ?? old('email') }}" required
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;">
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="password" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Новый пароль *</label>
                    <input type="password" name="password" id="password" required
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;">
                    <div style="font-size: 0.7rem; color: #888888; margin-top: 5px;">Минимум 6 символов</div>
                </div>
                
                <div style="margin-bottom: 24px;">
                    <label for="password_confirmation" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Подтверждение пароля *</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;">
                </div>
                
                <button type="submit" style="width: 100%; background: #D26F8B; color: #FFFFFF; font-weight: 600; padding: 14px; border-radius: 40px; border: none; cursor: pointer; transition: all 0.3s; font-size: 1rem;">
                    Сбросить пароль
                </button>
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
</style>
@endsection