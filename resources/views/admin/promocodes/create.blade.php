@extends('layouts.app')

@section('title', 'Создание промокода')

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    <div style="max-width: 600px; margin: 0 auto;">
        <h1 style="font-size: 2rem; font-weight: bold; margin-bottom: 24px; color: #1A1A1A;">Создание промокода</h1>
        
        <div style="background: #FFFFFF; border-radius: 24px; padding: 32px; border: 1px solid #F0E4E8;">
            <form action="{{ route('admin.promocodes.store') }}" method="POST">
                @csrf
                
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Код промокода *</label>
                    <input type="text" name="code" value="{{ old('code') }}" required style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px; text-transform: uppercase;">
                    @error('code')
                        <p style="color: #E53935; font-size: 0.75rem; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                    <p style="color: #888888; font-size: 0.75rem; margin-top: 4px;">Только буквы и цифры, без пробелов</p>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Тип скидки *</label>
                    <select name="type" id="type" required style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px;">
                        <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Процентная скидка (%)</option>
                        <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Фиксированная скидка (₽)</option>
                    </select>
                    @error('type')
                        <p style="color: #E53935; font-size: 0.75rem; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Значение скидки *</label>
                    <input type="number" name="value" id="value" step="1" value="{{ old('value') }}" required style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px;">
                    @error('value')
                        <p style="color: #E53935; font-size: 0.75rem; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                    <p id="value-hint" style="color: #888888; font-size: 0.75rem; margin-top: 4px;"></p>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Минимальная сумма заказа</label>
                    <input type="number" name="min_order_amount" step="1" value="{{ old('min_order_amount', 0) }}" style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px;">
                    @error('min_order_amount')
                        <p style="color: #E53935; font-size: 0.75rem; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Лимит использований</label>
                    <input type="number" name="usage_limit" value="{{ old('usage_limit', 1) }}" style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px;">
                    <p style="color: #888888; font-size: 0.75rem; margin-top: 4px;">Оставьте пустым для неограниченного использования</p>
                    @error('usage_limit')
                        <p style="color: #E53935; font-size: 0.75rem; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Действует до</label>
                    <input type="date" name="expires_at" value="{{ old('expires_at') }}" style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px;">
                    <p style="color: #888888; font-size: 0.75rem; margin-top: 4px;">Оставьте пустым для бессрочного действия</p>
                    @error('expires_at')
                        <p style="color: #E53935; font-size: 0.75rem; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>
                
                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Описание</label>
                    <textarea name="description" rows="3" style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px;">{{ old('description') }}</textarea>
                    <p style="color: #888888; font-size: 0.75rem; margin-top: 4px;">Например: "Скидка 10% на первый заказ"</p>
                    @error('description')
                        <p style="color: #E53935; font-size: 0.75rem; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>
                
                <div style="display: flex; gap: 16px;">
                    <button type="submit" style="flex: 1; background: #D26F8B; color: white; font-weight: 600; padding: 12px; border-radius: 40px; border: none; cursor: pointer; transition: all 0.3s;">
                        Сохранить
                    </button>
                    <a href="{{ route('admin.promocodes.index') }}" style="flex: 1; text-align: center; background: #F5F0F2; color: #1A1A1A; font-weight: 600; padding: 12px; border-radius: 40px; text-decoration: none; transition: all 0.3s;">
                        Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type');
        const valueInput = document.getElementById('value');
        const valueHint = document.getElementById('value-hint');
        
        function updateValueHint() {
            const type = typeSelect.value;
            const currentValue = valueInput.value;
            
            if (type === 'percent') {
                valueHint.innerHTML = 'Процент скидки (от 1 до 100)';
                valueInput.max = 100;
                valueInput.min = 1;
                valueInput.step = 1;
                if (currentValue > 100) {
                    valueInput.value = 100;
                }
            } else {
                valueHint.innerHTML = 'Фиксированная сумма скидки (от 1 до 999999 ₽)';
                valueInput.max = 999999;
                valueInput.min = 1;
                valueInput.step = 1;
            }
        }
        
        typeSelect.addEventListener('change', updateValueHint);
        updateValueHint();
    });
</script>

<style>
    button:hover {
        background: #E89BB3 !important;
        transform: translateY(-2px);
    }
    
    a[href="{{ route('admin.promocodes.index') }}"]:hover {
        background: #E8D0D8 !important;
    }
    
    input:focus, select:focus, textarea:focus {
        outline: none;
        border-color: #D26F8B !important;
        box-shadow: 0 0 0 3px rgba(210, 111, 139, 0.15);
    }
</style>
@endsection