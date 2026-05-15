@extends('layouts.app')

@section('title', 'Управление пользователями')

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    <div style="margin-bottom: 40px;">
        <h1 style="font-size: 2rem; font-weight: bold; color: #1A1A1A;">Управление пользователями</h1>
        <p style="color: #888888;">Просмотр и управление пользователями системы</p>
    </div>
    
    <div style="background: #FFFFFF; border-radius: 24px; overflow: hidden; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #F0E4E8; text-align: left;">
                        <th style="padding: 16px; color: #888888;">ID</th>
                        <th style="padding: 16px; color: #888888;">Имя</th>
                        <th style="padding: 16px; color: #888888;">Email</th>
                        <th style="padding: 16px; color: #888888;">Телефон</th>
                        <th style="padding: 16px; color: #888888;">Роль</th>
                        <th style="padding: 16px; color: #888888;">Дата регистрации</th>
                        <th style="padding: 16px; color: #888888;"></th>
                     </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr style="border-bottom: 1px solid #F0E4E8;">
                        <td style="padding: 16px; color: #1A1A1A;">{{ $user->id }}</td>
                        <td style="padding: 16px; color: #1A1A1A;">{{ $user->name }}</td>
                        <td style="padding: 16px; color: #4A4A4A;">{{ $user->email }}</td>
                        <td style="padding: 16px; color: #4A4A4A;">{{ $user->phone ?? '—' }}</td>
                        <td style="padding: 16px;">
                            @if($user->is_admin)
                                <span style="background: rgba(210, 111, 139, 0.1); color: #D26F8B; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem;">Администратор</span>
                            @else
                                <span style="background: #F5F0F2; color: #888888; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem;">Пользователь</span>
                            @endif
                        </td>
                        <td style="padding: 16px; color: #888888;">{{ $user->created_at->format('d.m.Y') }}</td>
                        <td style="padding: 16px;">
                            <a href="{{ route('admin.users.show', $user) }}" style="color: #D26F8B; text-decoration: none;">Подробнее</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div style="margin-top: 24px;">
        {{ $users->links() }}
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
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 0 16px;
        }
        h1 {
            font-size: 1.75rem !important;
        }
        table {
            font-size: 0.875rem;
        }
        th, td {
            padding: 12px !important;
        }
    }
    
    a:hover {
        color: #E89BB3 !important;
    }
    
    .pagination {
        display: flex;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    .pagination a, .pagination span {
        padding: 8px 16px;
        background: #FFFFFF;
        border: 1px solid #F0E4E8;
        border-radius: 8px;
        color: #4A4A4A;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .pagination a:hover {
        background: #D26F8B;
        color: #FFFFFF;
    }
    
    .pagination .active span {
        background: #D26F8B;
        color: #FFFFFF;
    }
</style>
@endsection