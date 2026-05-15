@extends('layouts.app')

@section('title', 'Управление товарами')

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
        <div>
            <h1 style="font-size: 2rem; font-weight: bold; color: #1A1A1A;">Управление товарами</h1>
            <p style="color: #AAAAAA;">Добавление и редактирование товаров</p>
        </div>
        <a href="{{ route('admin.products.create') }}" style="background: #D26F8B; color: #FFFFFF; padding: 10px 24px; border-radius: 40px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(210, 111, 139, 0.25); display: inline-block;">
            + Новый товар
        </a>
    </div>
    
    @if(session('success'))
        <div style="background: rgba(210, 111, 139, 0.1); border: 1px solid #D26F8B; border-radius: 12px; padding: 16px; margin-bottom: 24px;">
            <p style="color: #D26F8B;">✓ {{ session('success') }}</p>
        </div>
    @endif
    
    <div style="background: #FFFFFF; border-radius: 24px; overflow: hidden; border: 1px solid #F0E4E8; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #F0E4E8; text-align: left;">
                        <th style="padding: 16px 12px; color: #888888; font-weight: 600;">Фото</th>
                        <th style="padding: 16px 12px; color: #888888; font-weight: 600;">Название</th>
                        <th style="padding: 16px 12px; color: #888888; font-weight: 600;">Категория</th>
                        <th style="padding: 16px 12px; color: #888888; font-weight: 600;">Цена</th>
                        <th style="padding: 16px 12px; color: #888888; font-weight: 600;">Наличие</th>
                        <th style="padding: 16px 12px; color: #888888; font-weight: 600;">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr style="border-bottom: 1px solid #F0E4E8;">
                        <td style="padding: 12px;">
                            <div style="width: 50px; height: 50px; background: #FAF8F9; border-radius: 8px; overflow: hidden; border: 1px solid #F0E4E8;">
                                @if($product->image_path)
                                    <img src="{{ $product->image_path }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #AAAAAA; font-size: 0.7rem;">Нет</div>
                                @endif
                            </div>
                        </td>
                        <td style="padding: 12px; color: #1A1A1A; font-weight: 500;">{{ $product->name }}</td>
                        <td style="padding: 12px; color: #666666;">{{ $product->category->name }}</td>
                        <td style="padding: 12px; color: #D26F8B; font-weight: 700;">{{ number_format($product->price, 0, ',', ' ') }} ₽</td>
                        <td style="padding: 12px;">
                            @if($product->in_stock)
                                <span style="color: #4A7C59; background: rgba(74, 124, 89, 0.1); padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 500;">✓ В наличии</span>
                            @else
                                <span style="color: #E53935; background: rgba(229, 57, 53, 0.1); padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 500;">✗ Нет</span>
                            @endif
                        </td>
                        <td style="padding: 12px;">
                            <a href="{{ route('admin.products.edit', $product) }}" style="color: #D26F8B; text-decoration: none; margin-right: 16px; font-weight: 500; transition: color 0.3s;">Ред.</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color: #E53935; background: none; border: none; cursor: pointer; font-weight: 500; transition: opacity 0.3s;" onclick="return confirm('Удалить товар?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div style="margin-top: 32px;">
        {{ $products->links() }}
    </div>
</div>
@endsection