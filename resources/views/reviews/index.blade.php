@extends('layouts.app')

@section('title', 'Отзывы')

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    {{-- Заголовок --}}
    <div style="text-align: center; margin-bottom: 40px;">
        <h1 style="font-size: clamp(1.5rem, 5vw, 2rem); margin-bottom: 12px; color: #1A1A1A;">
            Отзывы <span style="color: #D26F8B;">наших клиентов</span>
        </h1>
        <p style="color: #888888; font-size: clamp(0.85rem, 3vw, 0.95rem); max-width: 500px; margin: 0 auto;">
            Мы ценим ваше мнение и стремимся стать лучше
        </p>
    </div>

    {{-- Блок с рейтингом и фильтрами --}}
    <div class="reviews-layout">
        {{-- Левая колонка: Статистика рейтинга --}}
        <div class="stats-card">
            <div style="text-align: center;">
                <div class="average-rating">{{ number_format($averageRating, 1) }}</div>
                <div class="stars-container">
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
                <div class="reviews-count">{{ $totalReviews }} {{ $totalReviews % 10 == 1 && $totalReviews % 100 != 11 ? 'отзыв' : ($totalReviews % 10 >= 2 && $totalReviews % 10 <= 4 && ($totalReviews % 100 < 10 || $totalReviews % 100 >= 20) ? 'отзыва' : 'отзывов') }}</div>
                
                {{-- Фильтр по рейтингу --}}
                <div class="rating-filters">
                    <div class="rating-filter-item {{ !request('rating') || request('rating') == 'all' ? 'active' : '' }}" data-rating="all">
                        <div class="filter-row">
                            <span class="filter-label">Все отзывы</span>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 100%;"></div>
                            </div>
                            <span class="filter-count">{{ $totalReviews }}</span>
                        </div>
                    </div>
                    @foreach([5,4,3,2,1] as $star)
                        <div class="rating-filter-item {{ request('rating') == $star ? 'active' : '' }}" data-rating="{{ $star }}">
                            <div class="filter-row">
                                <div class="filter-label">
                                    <span>{{ $star }}</span>
                                    <svg style="width: 14px; height: 14px; color: #FFB800;" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: {{ $totalReviews > 0 ? ($ratingDistribution[$star] / $totalReviews * 100) : 0 }}%;"></div>
                                </div>
                                <span class="filter-count">{{ $ratingDistribution[$star] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Правая колонка: Форма отправки отзыва --}}
        <div class="form-card">
            <h2 class="form-title">✍️ Написать отзыв</h2>
            
            @if(session('success'))
                <div class="alert-success">✓ {{ session('success') }}</div>
            @endif
            
            <form method="POST" action="{{ route('reviews.store') }}" id="review-form" novalidate>
                @csrf
                
                <div class="form-group">
                    <label for="author_name" class="form-label">Ваше имя <span class="required">*</span></label>
                    <input type="text" name="author_name" id="author_name" value="{{ old('author_name', auth()->user()->name ?? '') }}" class="form-input" required>
                    <div class="error-message" id="author_name-error"></div>
                    @error('author_name') <p class="field-error">❌ {{ $message }}</p> @enderror
                </div>
                
                <div class="form-group">
                    <label for="author_email" class="form-label">Email <span class="optional">(необязательно)</span></label>
                    <input type="email" name="author_email" id="author_email" value="{{ old('author_email', auth()->user()->email ?? '') }}" class="form-input">
                    <div class="error-message" id="author_email-error"></div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Ваша оценка <span class="required">*</span></label>
                    <div class="rating-input">
                        @for($i = 1; $i <= 5; $i++)
                            <label class="star-label">
                                <input type="radio" name="rating" value="{{ $i }}" class="star-radio" {{ old('rating') == $i ? 'checked' : '' }} required>
                                <svg class="star-svg" data-value="{{ $i }}" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </label>
                        @endfor
                    </div>
                    <div class="error-message" id="rating-error"></div>
                    @error('rating') <p class="field-error">❌ {{ $message }}</p> @enderror
                </div>
                
                <div class="form-group">
                    <label for="comment" class="form-label">Ваш отзыв <span class="optional">(необязательно)</span></label>
                    <textarea name="comment" id="comment" rows="3" class="form-input" placeholder="Расскажите о вашем опыте...">{{ old('comment') }}</textarea>
                    <div class="error-message" id="comment-error"></div>
                    @error('comment') <p class="field-error">❌ {{ $message }}</p> @enderror
                </div>
                
                <button type="submit" class="submit-btn">📨 Отправить отзыв</button>
                <p class="note-text">📝 Отзывы проходят модерацию перед публикацией</p>
            </form>
        </div>
    </div>
    
    {{-- Сортировка --}}
    <div class="sorting-bar">
        <div class="sorting-links">
            <span style="color: #888888; font-size: 0.85rem;">Сортировать:</span>
            <a href="{{ route('reviews.index', array_merge(request()->except('sort'), ['sort' => 'newest'])) }}" class="sort-link {{ request('sort', 'newest') == 'newest' ? 'active' : '' }}">Новые</a>
            <a href="{{ route('reviews.index', array_merge(request()->except('sort'), ['sort' => 'oldest'])) }}" class="sort-link {{ request('sort') == 'oldest' ? 'active' : '' }}">Старые</a>
            <a href="{{ route('reviews.index', array_merge(request()->except('sort'), ['sort' => 'highest'])) }}" class="sort-link {{ request('sort') == 'highest' ? 'active' : '' }}">Сначала высокие</a>
            <a href="{{ route('reviews.index', array_merge(request()->except('sort'), ['sort' => 'lowest'])) }}" class="sort-link {{ request('sort') == 'lowest' ? 'active' : '' }}">Сначала низкие</a>
        </div>
    </div>

    {{-- Список отзывов в квадратиках --}}
    <div class="reviews-grid">
        @forelse($reviews as $review)
            <div class="review-card">
                <div class="review-header">
                    <h3 class="review-author">{{ $review->author_name }}</h3>
                    <div class="review-stars">
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
                <p class="review-date">{{ $review->created_at->format('d.m.Y') }}</p>
                @if($review->comment)
                    <p class="review-comment">{{ $review->comment }}</p>
                @endif
                
                @if($review->response)
                    <div class="review-response">
                        <p class="response-title">Ответ администратора:</p>
                        <p class="response-text">{{ $review->response }}</p>
                    </div>
                @endif
            </div>
        @empty
            <div class="empty-reviews">
                <p>Пока нет отзывов. Будьте первым!</p>
            </div>
        @endforelse
    </div>

    {{-- Пагинация --}}
    @if($reviews->hasPages())
        <div class="pagination-container">
            <div class="pagination-links">
                @if ($reviews->onFirstPage())
                    <span class="pagination-disabled">← Назад</span>
                @else
                    <a href="{{ $reviews->previousPageUrl() }}" class="pagination-link">← Назад</a>
                @endif

                @php
                    $currentPage = $reviews->currentPage();
                    $lastPage = $reviews->lastPage();
                    $start = max(1, $currentPage - 2);
                    $end = min($lastPage, $currentPage + 2);
                @endphp

                @if ($start > 1)
                    <a href="{{ $reviews->url(1) }}" class="pagination-link">1</a>
                    @if ($start > 2)
                        <span class="pagination-dots">...</span>
                    @endif
                @endif

                @for ($i = $start; $i <= $end; $i++)
                    @if ($i == $currentPage)
                        <span class="pagination-current">{{ $i }}</span>
                    @else
                        <a href="{{ $reviews->url($i) }}" class="pagination-link">{{ $i }}</a>
                    @endif
                @endfor

                @if ($end < $lastPage)
                    @if ($end < $lastPage - 1)
                        <span class="pagination-dots">...</span>
                    @endif
                    <a href="{{ $reviews->url($lastPage) }}" class="pagination-link">{{ $lastPage }}</a>
                @endif

                @if ($reviews->hasMorePages())
                    <a href="{{ $reviews->nextPageUrl() }}" class="pagination-link">Вперед →</a>
                @else
                    <span class="pagination-disabled">Вперед →</span>
                @endif
            </div>
            <div class="pagination-info">
                Показано {{ $reviews->firstItem() }}–{{ $reviews->lastItem() }} из {{ $reviews->total() }} отзывов
            </div>
        </div>
    @endif
</div>

<style>
    .container {
        max-width: 1400px;
        width: 100%;
        margin: 0 auto;
        padding: 0 40px;
    }
    
    /* Layout */
    .reviews-layout {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 30px;
        margin-bottom: 40px;
    }
    
    /* Карточки */
    .stats-card, .form-card {
        background: #FFFFFF;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #F0E4E8;
    }
    
    .average-rating {
        font-size: 3rem;
        font-weight: bold;
        color: #D26F8B;
    }
    
    .stars-container {
        display: flex;
        gap: 4px;
        justify-content: center;
        margin: 8px 0;
    }
    
    .reviews-count {
        color: #888888;
        font-size: 0.875rem;
        margin-bottom: 20px;
    }
    
    /* Фильтры */
    .rating-filters {
        text-align: left;
    }
    
    .rating-filter-item {
        cursor: pointer;
        padding: 8px 10px;
        border-radius: 10px;
        margin-bottom: 5px;
        transition: all 0.3s;
    }
    
    .rating-filter-item.active {
        background: #F0E4E8;
        font-weight: 600;
    }
    
    .rating-filter-item:hover {
        background: #F0E4E8;
    }
    
    .filter-row {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .filter-label {
        min-width: 65px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    
    .progress-bar {
        flex: 1;
        background: #F0E4E8;
        border-radius: 10px;
        height: 6px;
        overflow: hidden;
    }
    
    .progress-fill {
        background: #D26F8B;
        height: 100%;
        border-radius: 10px;
    }
    
    .filter-count {
        min-width: 35px;
        text-align: right;
        color: #888888;
        font-size: 0.8rem;
    }
    
    /* Форма */
    .form-title {
        font-size: 1.3rem;
        font-weight: bold;
        margin-bottom: 20px;
        color: #1A1A1A;
        text-align: center;
    }
    
    .form-group {
        margin-bottom: 14px;
    }
    
    .form-label {
        display: block;
        font-size: 0.8rem;
        font-weight: 500;
        margin-bottom: 5px;
        color: #1A1A1A;
    }
    
    .required {
        color: #D26F8B;
    }
    
    .optional {
        color: #888888;
        font-weight: normal;
    }
    
    .form-input {
        width: 100%;
        background: #FAF8F9;
        border: 1px solid #F0E4E8;
        border-radius: 12px;
        padding: 10px 14px;
        font-size: 0.9rem;
        transition: all 0.3s;
        font-family: inherit;
        box-sizing: border-box;
    }
    
    .form-input:focus {
        border-color: #D26F8B;
        outline: none;
        box-shadow: 0 0 0 3px rgba(210, 111, 139, 0.1);
    }
    
    .input-error {
        border-color: #E53935 !important;
        background-color: #FFF5F5 !important;
    }
    
    .error-message {
        color: #E53935;
        font-size: 0.7rem;
        margin-top: 4px;
        display: none;
    }
    
    .field-error {
        color: #E53935;
        font-size: 0.7rem;
        margin-top: 3px;
    }
    
    .alert-success {
        margin-bottom: 20px;
        padding: 12px;
        background: rgba(210, 111, 139, 0.1);
        border: 1px solid #D26F8B;
        border-radius: 12px;
        color: #D26F8B;
        font-size: 0.875rem;
        text-align: center;
    }
    
    /* Звезды в форме */
    .rating-input {
        display: flex;
        gap: 10px;
    }
    
    .star-label {
        cursor: pointer;
    }
    
    .star-radio {
        display: none;
    }
    
    .star-svg {
        width: 28px;
        height: 28px;
        color: #E8E8E8;
        transition: all 0.2s;
        cursor: pointer;
    }
    
    .star-radio:checked + .star-svg,
    .star-svg.selected {
        color: #FFB800;
    }
    
    .star-label:hover .star-svg {
        color: #FFB800;
    }
    
    .submit-btn {
        width: 100%;
        background: #D26F8B;
        color: #FFFFFF;
        font-weight: 600;
        padding: 10px;
        border-radius: 40px;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 0.9rem;
        margin-top: 5px;
    }
    
    .submit-btn:hover {
        background: #E89BB3;
        transform: translateY(-2px);
    }
    
    .note-text {
        color: #888888;
        font-size: 0.7rem;
        text-align: center;
        margin-top: 10px;
    }
    
    /* Сортировка */
    .sorting-bar {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 20px;
    }
    
    .sorting-links {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .sort-link {
        padding: 5px 12px;
        background: #F5F0F2;
        color: #666666;
        text-decoration: none;
        border-radius: 20px;
        font-size: 0.75rem;
        transition: all 0.3s;
    }
    
    .sort-link.active {
        background: #D26F8B;
        color: #FFFFFF;
    }
    
    .sort-link:hover {
        background: #D26F8B;
        color: #FFFFFF;
    }
    
    /* Список отзывов - СЕТКА (квадратики) */
    .reviews-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 24px;
    }
    
    .review-card {
        background: #FFFFFF;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #F0E4E8;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .review-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(210, 111, 139, 0.1);
        border-color: #D26F8B;
    }
    
    .review-header {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 8px;
    }
    
    .review-author {
        font-size: 1rem;
        font-weight: 600;
        color: #1A1A1A;
        margin: 0;
    }
    
    .review-stars {
        display: flex;
        gap: 2px;
    }
    
    .review-date {
        color: #888888;
        font-size: 0.7rem;
        margin-bottom: 12px;
    }
    
    .review-comment {
        color: #4A4A4A;
        line-height: 1.5;
        font-size: 0.9rem;
        flex: 1;
    }
    
    .review-response {
        margin-top: 16px;
        padding: 12px;
        background: #FAF8F9;
        border-radius: 12px;
        border-left: 3px solid #D26F8B;
    }
    
    .response-title {
        color: #D26F8B;
        font-weight: 600;
        margin-bottom: 6px;
        font-size: 0.8rem;
    }
    
    .response-text {
        color: #666666;
        font-size: 0.85rem;
    }
    
    .empty-reviews {
        grid-column: 1 / -1;
        background: #FFFFFF;
        border-radius: 20px;
        padding: 40px 20px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #F0E4E8;
        color: #888888;
    }
    
    /* Пагинация */
    .pagination-container {
        margin-top: 40px;
        text-align: center;
    }
    
    .pagination-links {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    .pagination-link {
        padding: 6px 12px;
        background: #FFFFFF;
        border: 1px solid #F0E4E8;
        border-radius: 8px;
        color: #1A1A1A;
        text-decoration: none;
        font-size: 0.8rem;
        transition: all 0.3s;
    }
    
    .pagination-link:hover {
        background: #D26F8B;
        color: #FFFFFF;
    }
    
    .pagination-current {
        padding: 6px 12px;
        background: #D26F8B;
        color: #FFFFFF;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
    }
    
    .pagination-disabled {
        padding: 6px 12px;
        background: #F5F0F2;
        border: 1px solid #F0E4E8;
        border-radius: 8px;
        color: #AAAAAA;
        cursor: not-allowed;
        font-size: 0.8rem;
    }
    
    .pagination-dots {
        padding: 6px 12px;
        color: #AAAAAA;
        font-size: 0.8rem;
    }
    
    .pagination-info {
        text-align: center;
        margin-top: 12px;
        color: #AAAAAA;
        font-size: 0.75rem;
    }
    
    /* Адаптивность */
    @media (max-width: 1024px) {
        .container {
            padding: 0 20px;
        }
        
        .reviews-grid {
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        }
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 0 16px;
        }
        
        .reviews-layout {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .sorting-bar {
            justify-content: center;
        }
        
        .sorting-links {
            justify-content: center;
        }
        
        .reviews-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 480px) {
        .container {
            padding: 0 12px;
        }
        
        .star-svg {
            width: 22px !important;
            height: 22px !important;
        }
        
        .rating-input {
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .stats-card, .form-card {
            padding: 16px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Фильтр по рейтингу
    const filterItems = document.querySelectorAll('.rating-filter-item');
    filterItems.forEach(item => {
        item.addEventListener('click', function() {
            const rating = this.dataset.rating;
            const currentUrl = new URL(window.location.href);
            if (rating === 'all') {
                currentUrl.searchParams.delete('rating');
            } else {
                currentUrl.searchParams.set('rating', rating);
            }
            window.location.href = currentUrl.toString();
        });
    });
    
    // Звезды в форме
    const starRadios = document.querySelectorAll('.star-radio');
    const starSvgs = document.querySelectorAll('.star-svg');
    
    function updateStars(value) {
        starSvgs.forEach((svg, index) => {
            if (index < value) {
                svg.style.color = '#FFB800';
                svg.classList.add('selected');
            } else {
                svg.style.color = '#E8E8E8';
                svg.classList.remove('selected');
            }
        });
    }
    
    starRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            updateStars(parseInt(this.value));
        });
    });
    
    // Установить начальные звёзды
    const checkedRadio = document.querySelector('.star-radio:checked');
    if (checkedRadio) {
        updateStars(parseInt(checkedRadio.value));
    }
    
    // Валидация формы
    const form = document.getElementById('review-form');
    
    function showError(input, message) {
        input.classList.add('input-error');
        const errorDiv = document.getElementById(`${input.id}-error`);
        if (errorDiv) {
            errorDiv.textContent = `❌ ${message}`;
            errorDiv.style.display = 'block';
        }
    }
    
    function clearError(input) {
        input.classList.remove('input-error');
        const errorDiv = document.getElementById(`${input.id}-error`);
        if (errorDiv) {
            errorDiv.style.display = 'none';
            errorDiv.textContent = '';
        }
    }
    
    function validateForm() {
        let isValid = true;
        
        // Валидация имени
        const nameInput = document.getElementById('author_name');
        if (!nameInput.value.trim()) {
            showError(nameInput, 'Пожалуйста, укажите ваше имя');
            isValid = false;
        } else {
            clearError(nameInput);
        }
        
        // Валидация email (необязательно, но если заполнен - проверяем формат)
        const emailInput = document.getElementById('author_email');
        if (emailInput.value.trim()) {
            const emailRegex = /^[^\s@]+@([^\s@.,]+\.)+[^\s@.,]{2,}$/;
            if (!emailRegex.test(emailInput.value)) {
                showError(emailInput, 'Введите корректный email адрес (например: name@mail.ru)');
                isValid = false;
            } else {
                clearError(emailInput);
            }
        } else {
            clearError(emailInput);
        }
        
        // Валидация рейтинга
        const ratingSelected = document.querySelector('.star-radio:checked');
        if (!ratingSelected) {
            const ratingError = document.getElementById('rating-error');
            ratingError.textContent = '❌ Пожалуйста, выберите оценку';
            ratingError.style.display = 'block';
            isValid = false;
        } else {
            const ratingError = document.getElementById('rating-error');
            ratingError.style.display = 'none';
        }
        
        if (!isValid) {
            const firstError = document.querySelector('.input-error');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstError.focus();
            }
        }
        
        return isValid;
    }
    
    if (form) {
        form.setAttribute('novalidate', true);
        
        form.addEventListener('submit', function(e) {
            if (!validateForm()) {
                e.preventDefault();
            }
        });
        
        // Очистка ошибок при вводе
        const authorName = document.getElementById('author_name');
        const authorEmail = document.getElementById('author_email');
        
        if (authorName) {
            authorName.addEventListener('input', () => clearError(authorName));
            authorName.addEventListener('blur', () => {
                if (!authorName.value.trim()) {
                    showError(authorName, 'Пожалуйста, укажите ваше имя');
                } else {
                    clearError(authorName);
                }
            });
        }
        
        if (authorEmail) {
            authorEmail.addEventListener('input', () => clearError(authorEmail));
            authorEmail.addEventListener('blur', () => {
                if (authorEmail.value.trim()) {
                    const emailRegex = /^[^\s@]+@([^\s@.,]+\.)+[^\s@.,]{2,}$/;
                    if (!emailRegex.test(authorEmail.value)) {
                        showError(authorEmail, 'Введите корректный email адрес (например: name@mail.ru)');
                    } else {
                        clearError(authorEmail);
                    }
                }
            });
        }
    }
});
</script>
@endsection