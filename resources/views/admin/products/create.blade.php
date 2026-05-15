@extends('layouts.app')

@section('title', 'Добавить товар')

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    <div style="max-width: 800px; margin: 0 auto;">
        <h1 style="font-size: 2rem; font-weight: bold; margin-bottom: 24px; color: #1A1A1A;">Добавить товар</h1>
        
        <div style="background: #FFFFFF; border-radius: 24px; padding: 32px; border: 1px solid #F0E4E8;">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Название *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px;">
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Описание *</label>
                    <textarea name="description" rows="5" required style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px;">{{ old('description') }}</textarea>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Цена *</label>
                        <input type="number" name="price" step="1" value="{{ old('price') }}" required style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Категория *</label>
                        <select name="category_id" required style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px;">
                            <option value="">Выберите категорию</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Главное фото *</label>
                        <input type="file" name="main_image" accept="image/*" required style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 10px;">
                        <p style="color: #888888; font-size: 0.75rem; margin-top: 4px;">JPG, PNG, GIF до 2MB</p>
                    </div>
                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Дополнительные фото</label>
                        <input type="file" name="additional_images[]" accept="image/*" multiple style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 10px;">
                        <p style="color: #888888; font-size: 0.75rem; margin-top: 4px;">Можно выбрать несколько файлов (CTRL+клик)</p>
                    </div>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px;">
                    <div>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" name="in_stock" value="1" checked>
                            <span style="font-weight: 500; color: #1A1A1A;">В наличии</span>
                        </label>
                    </div>
                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Количество</label>
                        <input type="number" name="quantity" value="0" style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px;">
                    </div>
                </div>
                
                <div style="display: flex; gap: 16px;">
                    <button type="submit" style="flex: 1; background: #D26F8B; color: white; font-weight: 600; padding: 12px; border-radius: 40px; border: none; cursor: pointer;">Сохранить</button>
                    <a href="{{ route('admin.products.index') }}" style="flex: 1; text-align: center; background: #F5F0F2; color: #1A1A1A; font-weight: 600; padding: 12px; border-radius: 40px; text-decoration: none;">Отмена</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection