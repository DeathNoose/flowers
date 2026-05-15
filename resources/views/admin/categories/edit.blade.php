@extends('layouts.app')

@section('title', 'Редактирование категории')

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    <div style="max-width: 600px; margin: 0 auto;">
        <div style="background: #FFFFFF; border-radius: 24px; padding: 40px; border: 1px solid #F0E4E8; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
            <h1 style="font-size: 2rem; font-weight: bold; margin-bottom: 32px; color: #1A1A1A;">Редактирование категории</h1>
            
            <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                @csrf
                @method('PUT')
                
                <div style="margin-bottom: 20px;">
                    <label for="name" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #4A4A4A;">Название категории *</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s;">
                    @error('name')
                        <p style="color: #E53935; font-size: 0.875rem; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>
                
                <div style="margin-bottom: 24px;">
                    <label for="description" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #4A4A4A;">Описание</label>
                    <textarea name="description" id="description" rows="4"
                              style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; resize: vertical;">{{ old('description', $category->description) }}</textarea>
                </div>
                
                <div style="display: flex; gap: 16px;">
                    <button type="submit" style="flex: 1; background: #D26F8B; color: #FFFFFF; font-weight: 600; padding: 12px; border-radius: 40px; border: none; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(210, 111, 139, 0.25);">
                        Сохранить изменения
                    </button>
                    <a href="{{ route('admin.categories.index') }}" style="flex: 1; text-align: center; border: 2px solid #D26F8B; color: #D26F8B; background: transparent; padding: 12px; border-radius: 40px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
                        Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection