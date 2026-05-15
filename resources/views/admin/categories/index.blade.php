@extends('layouts.app')

@section('title', 'Управление категориями')

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
        <div>
            <h1 style="font-size: 2rem; font-weight: bold; color: #1A1A1A;">Управление категориями</h1>
            <p style="color: #AAAAAA;">Создание и редактирование категорий товаров</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" style="background: #D26F8B; color: #FFFFFF; padding: 10px 24px; border-radius: 40px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(210, 111, 139, 0.25); display: inline-block;">
            + Новая категория
        </a>
    </div>
    
    @if(session('success'))
        <div style="background: rgba(210, 111, 139, 0.1); border: 1px solid #D26F8B; border-radius: 12px; padding: 16px; margin-bottom: 24px;">
            <p style="color: #D26F8B;">✓ {{ session('success') }}</p>
        </div>
    @endif
    
    @if(session('error'))
        <div style="background: rgba(229, 57, 53, 0.1); border: 1px solid #E53935; border-radius: 12px; padding: 16px; margin-bottom: 24px;">
            <p style="color: #E53935;">⚠ {{ session('error') }}</p>
        </div>
    @endif
    
    <div style="background: #FFFFFF; border-radius: 24px; overflow: hidden; border: 1px solid #F0E4E8; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #F0E4E8; text-align: left;">
                        <th style="padding: 16px; color: #888888; font-weight: 600;">ID</th>
                        <th style="padding: 16px; color: #888888; font-weight: 600;">Название</th>
                        <th style="padding: 16px; color: #888888; font-weight: 600;">Slug</th>
                        <th style="padding: 16px; color: #888888; font-weight: 600;">Товаров</th>
                        <th style="padding: 16px; color: #888888; font-weight: 600;">Дата</th>
                        <th style="padding: 16px; color: #888888; font-weight: 600;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr style="border-bottom: 1px solid #F0E4E8;">
                        <td style="padding: 16px; color: #1A1A1A; font-weight: 500;">{{ $category->id }}</td>
                        <td style="padding: 16px; color: #1A1A1A; font-weight: 500;">{{ $category->name }}</td>
                        <td style="padding: 16px; color: #666666;">{{ $category->slug }}</td>
                        <td style="padding: 16px; color: #D26F8B; font-weight: 700;">{{ $category->flowers()->count() }}</td>
                        <td style="padding: 16px; color: #AAAAAA; font-size: 0.875rem;">{{ $category->created_at->format('d.m.Y') }}</td>
                        <td style="padding: 16px;">
                            <a href="{{ route('admin.categories.edit', $category) }}" style="color: #D26F8B; text-decoration: none; margin-right: 16px; font-weight: 500; transition: color 0.3s;">Редактировать</a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color: #E53935; background: none; border: none; cursor: pointer; font-weight: 500; transition: opacity 0.3s;" onclick="return confirm('Удалить категорию? Все товары в этой категории также будут удалены!')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div style="margin-top: 32px;">
        {{ $categories->links() }}
    </div>
</div>
@endsection