@extends('layouts.app')

@section('title', 'Отзывы')

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    {{-- Заголовок --}}
    <div style="text-align: center; margin-bottom: 60px;">
        <h1 style="font-size: 2rem; margin-bottom: 16px; color: #1A1A1A;">
            Отзывы <span style="color: #D26F8B;">наших клиентов</span>
        </h1>
        <p style="color: #888888; font-size: 1rem; max-width: 600px; margin: 0 auto; padding: 0 16px;">
            Мы ценим ваше мнение и стремимся стать лучше
        </p>
    </div>

    {{-- Блок с рейтингом --}}
    <div style="background: #FFFFFF; border-radius: 24px; padding: 24px 20px; margin-bottom: 40px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
        <div style="display: flex; flex-direction: column; align-items: center; gap: 24px;">
            {{-- Общая оценка --}}
            <div style="text-align: center;">
                <div style="font-size: 3rem; font-weight: bold; color: #D26F8B;">{{ number_format($averageRating, 1) }}</div>
                <div style="display: flex; gap: 4px; justify-content: center; margin: 8px 0;">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= round($averageRating))
                            <svg style="width: 20px; height: 20px; color: #FFB800;" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @else
                            <svg style="width: 20px; height: 20px; color: #E8E8E8;" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endif
                    @endfor
                </div>
                <div style="color: #888888; font-size: 0.875rem;">{{ $totalReviews }} {{ $totalReviews % 10 == 1 && $totalReviews % 100 != 11 ? 'отзыв' : ($totalReviews % 10 >= 2 && $totalReviews % 10 <= 4 && ($totalReviews % 100 < 10 || $totalReviews % 100 >= 20) ? 'отзыва' : 'отзывов') }}</div>
            </div>

            {{-- Распределение оценок --}}
            <div style="width: 100%; max-width: 100%;">
                @foreach([5,4,3,2,1] as $star)
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px; flex-wrap: wrap;">
                        <div style="min-width: 65px; color: #666666; font-size: 0.8rem;">{{ $star }} звезд</div>
                        <div style="flex: 1; min-width: 120px; background: #F0E4E8; border-radius: 10px; height: 8px; overflow: hidden;">
                            <div style="width: {{ $totalReviews > 0 ? ($ratingDistribution[$star] / $totalReviews * 100) : 0 }}%; background: #D26F8B; height: 100%; border-radius: 10px;"></div>
                        </div>
                        <div style="min-width: 35px; color: #888888; font-size: 0.8rem; text-align: right;">{{ $ratingDistribution[$star] }}</div>
                    </div>
                @endforeach
            </div>

            {{-- Кнопка написания отзыва --}}
            <div>
                <button onclick="document.getElementById('review-form').scrollIntoView({ behavior: 'smooth' })" style="background: #D26F8B; color: #FFFFFF; border: none; padding: 12px 24px; border-radius: 40px; font-weight: 600; cursor: pointer; transition: all 0.3s; width: 100%;">
                    Написать отзыв
                </button>
            </div>
        </div>
    </div>

    {{-- Список отзывов --}}
    <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
        @forelse($reviews as $review)
            <div style="background: #FFFFFF; border-radius: 20px; padding: 20px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
                <div style="margin-bottom: 12px;">
                    <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 8px;">
                        <h3 style="font-size: 1rem; font-weight: 600; color: #1A1A1A;">{{ $review->author_name }}</h3>
                        <div style="display: flex; gap: 2px;">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rating)
                                    <svg style="width: 14px; height: 14px; color: #FFB800;" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @else
                                    <svg style="width: 14px; height: 14px; color: #E8E8E8;" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                    </div>
                    <p style="color: #888888; font-size: 0.7rem;">{{ $review->created_at->format('d.m.Y') }}</p>
                </div>
                <p style="color: #4A4A4A; line-height: 1.5; font-size: 0.9rem;">{{ $review->comment }}</p>
                
                @if($review->response)
                    <div style="margin-top: 16px; padding: 12px; background: #FAF8F9; border-radius: 12px; border-left: 3px solid #D26F8B;">
                        <p style="color: #D26F8B; font-weight: 600; margin-bottom: 6px; font-size: 0.8rem;">Ответ администратора:</p>
                        <p style="color: #666666; font-size: 0.85rem;">{{ $review->response }}</p>
                    </div>
                @endif
            </div>
        @empty
            <div style="background: #FFFFFF; border-radius: 20px; padding: 40px 20px; text-align: center; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
                <p style="color: #888888; font-size: 1rem;">Пока нет отзывов. Будьте первым!</p>
            </div>
        @endforelse
    </div>

    <div style="margin-top: 40px;">
        {{ $reviews->links() }}
    </div>

    {{-- Форма добавления отзыва --}}
    <div id="review-form" style="background: #FFFFFF; border-radius: 24px; padding: 24px 20px; margin-top: 60px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
        <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 20px; color: #1A1A1A; text-align: center;">Оставить отзыв</h2>
        
        @if(session('success'))
            <div style="margin-bottom: 20px; padding: 12px; background: rgba(210, 111, 139, 0.1); border: 1px solid #D26F8B; border-radius: 12px; color: #D26F8B; font-size: 0.875rem; text-align: center;">
                {{ session('success') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('reviews.store') }}">
            @csrf
            
            <div style="display: flex; flex-direction: column; gap: 16px;">
                <div>
                    <label for="author_name" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Ваше имя *</label>
                    <input type="text" name="author_name" id="author_name" value="{{ old('author_name', auth()->user()->name ?? '') }}" required
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s; outline: none;">
                    @error('author_name') <p style="color: #E53935; font-size: 0.75rem; margin-top: 4px;">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="author_email" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Email (необязательно)</label>
                    <input type="email" name="author_email" id="author_email" value="{{ old('author_email', auth()->user()->email ?? '') }}"
                           style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s; outline: none;">
                </div>
            </div>
            
            <div style="margin: 16px 0;">
                <label style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Ваша оценка *</label>
                <div class="rating-input" style="display: flex; gap: 8px; justify-content: center; flex-wrap: wrap;">
                    @for($i = 1; $i <= 5; $i++)
                        <label style="cursor: pointer;">
                            <input type="radio" name="rating" value="{{ $i }}" style="display: none;" {{ old('rating') == $i ? 'checked' : '' }}>
                            <svg class="rating-star" data-value="{{ $i }}" style="width: 32px; height: 32px; color: {{ old('rating') >= $i ? '#FFB800' : '#E8E8E8' }}; cursor: pointer;" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </label>
                    @endfor
                </div>
                @error('rating') <p style="color: #E53935; font-size: 0.75rem; margin-top: 4px; text-align: center;">{{ $message }}</p> @enderror
            </div>
            
            <div style="margin-bottom: 20px;">
                <label for="comment" style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #1A1A1A;">Ваш отзыв *</label>
                <textarea name="comment" id="comment" rows="5" required
                          style="width: 100%; background: #FAF8F9; border: 1px solid #F0E4E8; border-radius: 12px; padding: 12px 16px; color: #1A1A1A; transition: all 0.3s; outline: none; resize: vertical;">{{ old('comment') }}</textarea>
                @error('comment') <p style="color: #E53935; font-size: 0.75rem; margin-top: 4px;">{{ $message }}</p> @enderror
            </div>
            
            <button type="submit" style="width: 100%; background: #D26F8B; color: #FFFFFF; font-weight: 600; padding: 14px 32px; border-radius: 40px; border: none; cursor: pointer; transition: all 0.3s;">
                Отправить отзыв
            </button>
            <p style="color: #888888; font-size: 0.7rem; margin-top: 12px; text-align: center;">Отзывы проходят модерацию перед публикацией</p>
        </form>
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
        .rating-star {
            width: 28px !important;
            height: 28px !important;
        }
    }
    
    @media (max-width: 480px) {
        .container {
            padding: 0 12px;
        }
        h1 {
            font-size: 1.5rem !important;
        }
        .rating-star {
            width: 24px !important;
            height: 24px !important;
        }
        [style*="border-radius: 24px"] {
            border-radius: 16px !important;
        }
        [style*="padding: 24px 20px"] {
            padding: 20px 16px !important;
        }
    }
    
    input:focus, textarea:focus {
        border-color: #D26F8B !important;
        box-shadow: 0 0 0 3px rgba(210, 111, 139, 0.15) !important;
    }
    
    button:hover {
        background: #E89BB3 !important;
        transform: translateY(-2px);
    }
    
    /* Пагинация */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
        margin-top: 20px;
    }
    
    .pagination a, .pagination span {
        padding: 8px 14px;
        background: #FFFFFF;
        border: 1px solid #F0E4E8;
        border-radius: 8px;
        color: #1A1A1A;
        text-decoration: none;
        transition: all 0.3s;
        font-size: 0.875rem;
    }
    
    .pagination a:hover {
        background: #D26F8B;
        color: #FFFFFF;
        border-color: #D26F8B;
    }
    
    .pagination .active span {
        background: #D26F8B;
        color: #FFFFFF;
        border-color: #D26F8B;
    }
    
    @media (max-width: 576px) {
        .pagination a, .pagination span {
            padding: 6px 10px;
            font-size: 0.75rem;
        }
    }
    
    /* Анимация при наведении на карточки */
    [style*="border-radius: 20px"]:hover {
        transform: translateY(-2px);
        transition: transform 0.3s ease;
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.08);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.rating-star');
    const radioInputs = document.querySelectorAll('.rating-input input');
    
    stars.forEach((star, index) => {
        star.addEventListener('click', function() {
            const value = parseInt(this.dataset.value);
            if (radioInputs[index]) {
                radioInputs[index].checked = true;
            }
            
            stars.forEach((s, i) => {
                if (i < value) {
                    s.style.color = '#FFB800';
                } else {
                    s.style.color = '#E8E8E8';
                }
            });
        });
    });
});
</script>
@endsection