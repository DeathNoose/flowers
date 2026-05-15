@extends('layouts.app')

@section('title', 'Вход')

@section('content')
<div class="container" style="padding: 80px 0;">
    <div style="max-width: 500px; margin: 0 auto;">
        <div style="background: #FFFFFF; border-radius: 24px; padding: 40px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
            <h1 style="font-size: 2rem; font-weight: bold; margin-bottom: 32px; text-align: center; color: #1A1A1A;">Вход</h1>
            
            @if($errors->any())
                <div style="background: rgba(229, 57, 53, 0.1); border: 1px solid #E53935; border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                    @foreach($errors->all() as $error)
                        <p style="color: #E53935; font-size: 0.875rem;">{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div style="margin-bottom: 20px;">
                    <label for="email" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;">
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="password" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Пароль</label>
                    <input type="password" name="password" id="password" required
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;">
                </div>
                
                <div style="margin-bottom: 24px;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="remember" style="width: 16px; height: 16px;">
                        <span style="color: #888888; font-size: 0.875rem;">Запомнить меня</span>
                    </label>
                </div>
                
                <button type="submit" style="width: 100%; background: #D26F8B; color: #FFFFFF; font-weight: 600; padding: 14px; border-radius: 40px; border: none; cursor: pointer; transition: all 0.3s;">
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
@endsection