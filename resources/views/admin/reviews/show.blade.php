@extends('layouts.app')

@section('title', 'Отзыв #' . $review->id)

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 32px;">
        <div>
            <h1 style="font-size: 2rem; font-weight: bold; color: #1A1A1A;">Отзыв #{{ $review->id }}</h1>
            <p style="color: #888888;">от {{ $review->created_at->format('d.m.Y H:i') }}</p>
        </div>
        <a href="{{ route('admin.reviews.index') }}" style="color: #D26F8B; text-decoration: none;">← Назад к отзывам</a>
    </div>
    
    @if(session('success'))
        <div style="margin-bottom: 24px; padding: 16px; background: rgba(210, 111, 139, 0.1); border: 1px solid #D26F8B; border-radius: 12px; color: #D26F8B;">
            {{ session('success') }}
        </div>
    @endif
    
    <div style="display: grid; grid-template-columns: 1fr; gap: 32px; lg:grid-template-columns: 2fr 1fr;">
        <!-- Информация об отзыве -->
        <div style="background: #FFFFFF; border-radius: 24px; padding: 32px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
            <h2 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 20px; color: #1A1A1A;">Информация об отзыве</h2>
            
            <div style="margin-bottom: 16px;">
                <p style="color: #888888; font-size: 0.75rem;">Автор</p>
                <p style="color: #1A1A1A; font-weight: 500;">{{ $review->author_name }}</p>
            </div>
            
            <div style="margin-bottom: 16px;">
                <p style="color: #888888; font-size: 0.75rem;">Email</p>
                <p style="color: #1A1A1A;">{{ $review->author_email ?? 'Не указан' }}</p>
            </div>
            
            <div style="margin-bottom: 16px;">
                <p style="color: #888888; font-size: 0.75rem;">Оценка</p>
                <div style="display: flex; gap: 4px; margin-top: 8px;">
                    @for($i = 1; $i <= 5; $i++)
                        <svg style="width: 24px; height: 24px; color: {{ $i <= $review->rating ? '#FFB800' : '#E8E8E8' }};" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    @endfor
                </div>
            </div>
            
            <div>
                <p style="color: #888888; font-size: 0.75rem;">Отзыв</p>
                <p style="color: #4A4A4A; line-height: 1.6; margin-top: 8px; background: #FAF8F9; padding: 16px; border-radius: 16px;">{{ $review->comment }}</p>
            </div>
        </div>
        
        <!-- Управление и ответ -->
        <div>
            <!-- Управление -->
            <div style="background: #FFFFFF; border-radius: 24px; padding: 32px; margin-bottom: 24px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
                <h2 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 20px; color: #1A1A1A;">Управление</h2>
                
                @if($review->is_approved)
                    <form method="POST" action="{{ route('admin.reviews.disapprove', $review) }}" style="margin-bottom: 16px;">
                        @csrf
                        <button type="submit" style="width: 100%; background: #E53935; color: white; font-weight: 600; padding: 12px; border-radius: 40px; border: none; cursor: pointer; transition: all 0.3s;">
                            Скрыть с сайта
                        </button>
                    </form>
                @else
                    <form method="POST" action="{{ route('admin.reviews.approve', $review) }}" style="margin-bottom: 16px;">
                        @csrf
                        <button type="submit" style="width: 100%; background: #D26F8B; color: white; font-weight: 600; padding: 12px; border-radius: 40px; border: none; cursor: pointer; transition: all 0.3s;">
                            Одобрить и опубликовать
                        </button>
                    </form>
                @endif
                
                <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="width: 100%; background: transparent; color: #E53935; font-weight: 600; padding: 12px; border-radius: 40px; border: 1px solid #E53935; cursor: pointer; transition: all 0.3s;" onclick="return confirm('Удалить этот отзыв?')">
                        Удалить отзыв
                    </button>
                </form>
            </div>
            
            <!-- Ответ администратора -->
            <div style="background: #FFFFFF; border-radius: 24px; padding: 32px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
                <h2 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 20px; color: #1A1A1A;">Ответ администратора</h2>
                
                <form method="POST" action="{{ route('admin.reviews.response', $review) }}">
                    @csrf
                    <textarea name="response" rows="4" style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 16px; padding: 12px 16px; color: #1A1A1A; resize: vertical; margin-bottom: 16px; font-family: inherit;">{{ $review->response }}</textarea>
                    <button type="submit" style="width: 100%; background: #D26F8B; color: white; font-weight: 600; padding: 12px; border-radius: 40px; border: none; cursor: pointer; transition: all 0.3s;">
                        Сохранить ответ
                    </button>
                </form>
            </div>
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
            font-size: 1.5rem !important;
        }
        [style*="display: grid; grid-template-columns: 1fr; gap: 32px; lg:grid-template-columns: 2fr 1fr;"] {
            grid-template-columns: 1fr !important;
        }
        [style*="padding: 32px"] {
            padding: 20px !important;
        }
    }
    
    button:hover {
        transform: translateY(-2px);
    }
    
    .approve-btn:hover {
        background: #E89BB3 !important;
    }
    
    .hide-btn:hover {
        background: #EF5350 !important;
    }
    
    .delete-btn:hover {
        background: rgba(229,57,53,0.1) !important;
    }
    
    textarea:focus {
        border-color: #D26F8B !important;
        outline: none;
        box-shadow: 0 0 0 3px rgba(210, 111, 139, 0.15);
    }
</style>
@endsection