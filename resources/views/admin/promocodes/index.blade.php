@extends('layouts.app')

@section('title', 'Управление промокодами')

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
        <div>
            <h1 style="font-size: 2rem; font-weight: bold; color: #1A1A1A;">Управление промокодами</h1>
            <p style="color: #888888;">Создание и управление промокодами для скидок</p>
        </div>
        <a href="{{ route('admin.promocodes.create') }}" style="background: #D26F8B; color: white; padding: 10px 24px; border-radius: 40px; text-decoration: none; transition: all 0.3s;">
            + Создать промокод
        </a>
    </div>
    
    <div style="background: #FFFFFF; border-radius: 24px; overflow: hidden; border: 1px solid #F0E4E8;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #F0E4E8; background: #FAF8F9;">
                        <th style="padding: 16px; text-align: left; color: #888888;">Код</th>
                        <th style="padding: 16px; text-align: left; color: #888888;">Тип</th>
                        <th style="padding: 16px; text-align: left; color: #888888;">Значение</th>
                        <th style="padding: 16px; text-align: left; color: #888888;">Мин. сумма</th>
                        <th style="padding: 16px; text-align: left; color: #888888;">Использован</th>
                        <th style="padding: 16px; text-align: left; color: #888888;">Действует до</th>
                        <th style="padding: 16px; text-align: left; color: #888888;">Статус</th>
                        <th style="padding: 16px; text-align: center; color: #888888;">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($promocodes as $promocode)
                    <tr style="border-bottom: 1px solid #F0E4E8;">
                        <td style="padding: 16px; color: #1A1A1A; font-weight: 600;">{{ $promocode->code }}</td>
                        <td style="padding: 16px; color: #4A4A4A;">{{ $promocode->type == 'percent' ? 'Процент' : 'Фиксированная' }}</td>
                        <td style="padding: 16px; color: #D26F8B; font-weight: 600;">{{ $promocode->type == 'percent' ? $promocode->value . '%' : number_format($promocode->value, 0, ',', ' ') . ' ₽' }}</td>
                        <td style="padding: 16px; color: #4A4A4A;">{{ $promocode->min_order_amount > 0 ? number_format($promocode->min_order_amount, 0, ',', ' ') . ' ₽' : '—' }}</td>
                        <td style="padding: 16px; color: #4A4A4A;">{{ $promocode->used_count }} / {{ $promocode->usage_limit ?? '∞' }}</td>
                        <td style="padding: 16px; color: #4A4A4A;">{{ $promocode->expires_at ? $promocode->expires_at->format('d.m.Y') : '∞' }}</td>
                        <td style="padding: 16px;">
                            @if($promocode->is_active)
                                <span style="background: rgba(74, 124, 89, 0.1); color: #4A7C59; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem;">Активен</span>
                            @else
                                <span style="background: rgba(229, 57, 53, 0.1); color: #E53935; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem;">Отключен</span>
                            @endif
                        </td>
                        <td style="padding: 16px; text-align: center;">
                            <a href="{{ route('admin.promocodes.edit', $promocode) }}" style="color: #D26F8B; margin-right: 12px; text-decoration: none; font-size: 1.1rem;">✎</a>
                            <form action="{{ route('admin.promocodes.destroy', $promocode) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Удалить промокод {{ $promocode->code }}?')" style="background: none; border: none; color: #E53935; cursor: pointer; font-size: 1.1rem;">🗑</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="padding: 60px 20px; text-align: center; color: #888888;">
                            <svg style="width: 64px; height: 64px; margin: 0 auto 16px; color: #D26F8B; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 2C8 2 4 5 4 9c0 5 8 13 8 13s8-8 8-13c0-4-4-7-8-7z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v4m0 4h.01" />
                            </svg>
                            <p style="font-size: 1.1rem; margin-bottom: 8px;">Нет созданных промокодов</p>
                            <p style="font-size: 0.875rem;">Нажмите «Создать промокод», чтобы добавить первый промокод</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div style="margin-top: 24px;">
        {{ $promocodes->links() }}
    </div>
</div>

<style>
    a[href="{{ route('admin.promocodes.create') }}"]:hover {
        background: #E89BB3 !important;
        transform: translateY(-2px);
    }
    
    a[href="{{ route('admin.promocodes.edit', ['promocode' => 0]) }}"]:hover {
        color: #E89BB3 !important;
    }
    
    button:hover {
        opacity: 0.7;
    }
    
    @media (max-width: 768px) {
        th, td {
            padding: 12px !important;
            font-size: 0.8rem;
        }
    }
</style>
@endsection