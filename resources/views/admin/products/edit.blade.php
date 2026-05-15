@extends('layouts.app')

@section('title', 'Редактирование товара')

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    <div style="max-width: 800px; margin: 0 auto;">
        <div style="background: #FFFFFF; border-radius: 24px; padding: 40px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
            <h1 style="font-size: 2rem; font-weight: bold; margin-bottom: 32px; color: #1A1A1A;">Редактирование товара</h1>
            
            <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div style="margin-bottom: 20px;">
                    <label for="name" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #4A4A4A;">Название товара *</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A;">
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="category_id" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #4A4A4A;">Категория *</label>
                    <select name="category_id" id="category_id" required
                            style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A;">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="price" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #4A4A4A;">Цена (₽) *</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required step="1" min="0"
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A;">
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="description" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #4A4A4A;">Описание *</label>
                    <textarea name="description" id="description" rows="5" required
                              style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; resize: vertical;">{{ old('description', $product->description) }}</textarea>
                </div>
                
                <!-- ========== ИСПРАВЛЕННЫЙ БЛОК С ФОТО ========== -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #4A4A4A;">Текущее фото</label>
                    @if($product->image_path)
                        <div style="margin-bottom: 12px;">
                             <img src="{{ $product->image_path }}" alt="{{ $product->name }}" 
                                 alt="{{ $product->name }}" 
                                 style="max-width: 150px; max-height: 150px; border-radius: 12px; border: 1px solid #F0E4E8; object-fit: cover;">
                        </div>
                    @else
                        <div style="margin-bottom: 12px; color: #AAAAAA; padding: 10px; background: #FAF8F9; border-radius: 12px;">
                            Фото не загружено
                        </div>
                    @endif
                    
                    <label for="image" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #4A4A4A;">Новое фото</label>
                    <input type="file" name="image" id="image" accept="image/*"
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A;">
                    <p style="color: #AAAAAA; font-size: 0.75rem; margin-top: 4px;">Оставьте пустым, чтобы сохранить текущее фото</p>
                </div>
                <!-- ========================================== -->
                
                <div style="margin-bottom: 24px;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="in_stock" value="1" {{ $product->in_stock ? 'checked' : '' }} style="accent-color: #D26F8B;">
                        <span style="color: #4A4A4A;">В наличии</span>
                    </label>
                </div>
                
                <div style="display: flex; gap: 16px;">
                    <button type="submit" style="flex: 1; background: #D26F8B; color: #FFFFFF; font-weight: 600; padding: 12px; border-radius: 40px; border: none; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(210, 111, 139, 0.25);">
                        Сохранить изменения
                    </button>
                    <a href="{{ route('admin.products.index') }}" style="flex: 1; text-align: center; border: 2px solid #D26F8B; color: #D26F8B; background: transparent; padding: 12px; border-radius: 40px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
                        Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection