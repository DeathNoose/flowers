@extends('layouts.app')

@section('title', 'Пользователь: ' . $user->name)

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
        <div>
            <h1 style="font-size: 2rem; font-weight: bold; color: #1A1A1A;">{{ $user->name }}</h1>
            <p style="color: #888888;">{{ $user->email }}</p>
        </div>
        <a href="{{ route('admin.users.index') }}" style="color: #D26F8B; text-decoration: none;">← Назад к пользователям</a>
    </div>
    
    <div style="display: grid; grid-template-columns: 1fr; gap: 32px; lg:grid-template-columns: 1fr 1fr;">
        <!-- Информация о пользователе -->
        <div style="background: #FFFFFF; border-radius: 24px; padding: 32px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
            <h2 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 20px; color: #1A1A1A;">Информация о пользователе</h2>
            <div style="margin-bottom: 16px;">
                <p style="color: #888888; font-size: 0.75rem;">Имя</p>
                <p style="color: #1A1A1A;">{{ $user->name }}</p>
            </div>
            <div style="margin-bottom: 16px;">
                <p style="color: #888888; font-size: 0.75rem;">Email</p>
                <p style="color: #1A1A1A;">{{ $user->email }}</p>
            </div>
            <div style="margin-bottom: 16px;">
                <p style="color: #888888; font-size: 0.75rem;">Телефон</p>
                <p style="color: #1A1A1A;">{{ $user->phone ?? 'Не указан' }}</p>
            </div>
            <div style="margin-bottom: 16px;">
                <p style="color: #888888; font-size: 0.75rem;">Адрес</p>
                <p style="color: #1A1A1A;">{{ $user->address ?? 'Не указан' }}</p>
            </div>
            <div>
                <p style="color: #888888; font-size: 0.75rem;">Дата регистрации</p>
                <p style="color: #1A1A1A;">{{ $user->created_at->format('d.m.Y H:i') }}</p>
            </div>
        </div>
        
        <!-- Управление правами -->
        <div style="background: #FFFFFF; border-radius: 24px; padding: 32px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
            <h2 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 20px; color: #1A1A1A;">Управление правами</h2>
            
            <div style="margin-bottom: 24px;">
                <p style="color: #888888; font-size: 0.75rem; margin-bottom: 8px;">Текущая роль</p>
                @if($user->is_admin)
                    <div style="background: rgba(210, 111, 139, 0.05); border: 1px solid #D26F8B; border-radius: 12px; padding: 12px; margin-bottom: 16px;">
                        <p style="color: #D26F8B; font-weight: 600;">Администратор</p>
                        <p style="color: #888888; font-size: 0.75rem;">Пользователь имеет полный доступ к админ-панели</p>
                    </div>
                    <form method="POST" action="{{ route('admin.users.remove-admin', $user) }}">
                        @csrf
                        <button type="submit" style="width: 100%; background: #E53935; color: white; font-weight: 600; padding: 12px; border-radius: 40px; border: none; cursor: pointer; transition: all 0.3s;">
                            Снять права администратора
                        </button>
                    </form>
                @else
                    <div style="background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px; margin-bottom: 16px;">
                        <p style="color: #666666;">Пользователь</p>
                        <p style="color: #888888; font-size: 0.75rem;">Обычный пользователь без прав администратора</p>
                    </div>
                    <form method="POST" action="{{ route('admin.users.make-admin', $user) }}">
                        @csrf
                        <button type="submit" style="width: 100%; background: #D26F8B; color: #FFFFFF; font-weight: 600; padding: 12px; border-radius: 40px; border: none; cursor: pointer; transition: all 0.3s;">
                            Назначить администратором
                        </button>
                    </form>
                @endif
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
        [style*="grid-template-columns: 1fr; lg:grid-template-columns: 1fr 1fr;"] {
            grid-template-columns: 1fr !important;
            gap: 32px !important;
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
    
    a[href="{{ route('admin.users.index') }}"]:hover {
        color: #E89BB3 !important;
    }
    
    button[type="submit"]:hover {
        transform: translateY(-2px);
    }
    
    .btn-make-admin:hover {
        background: #E89BB3 !important;
    }
    
    .btn-remove-admin:hover {
        background: #EF4444 !important;
        opacity: 0.9;
    }
</style>
@endsection