@extends('layouts.app')

@section('title', 'Управление отзывами')

@section('content')
<div class="container" style="padding: 60px 0 80px;">
    <div style="margin-bottom: 40px;">
        <h1 style="font-size: 2rem; font-weight: bold; color: #1A1A1A;">Управление отзывами</h1>
        <p style="color: #888888;">Модерация и управление отзывами клиентов</p>
    </div>
    
    @if(session('success'))
        <div style="margin-bottom: 24px; padding: 16px; background: rgba(210, 111, 139, 0.1); border: 1px solid #D26F8B; border-radius: 12px; color: #D26F8B;">
            {{ session('success') }}
        </div>
    @endif
    
    <div style="background: #FFFFFF; border-radius: 24px; overflow: hidden; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); border: 1px solid #F0E4E8;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #F0E4E8; text-align: left;">
                        <th style="padding: 16px; color: #666666;">ID</th>
                        <th style="padding: 16px; color: #666666;">Автор</th>
                        <th style="padding: 16px; color: #666666;">Оценка</th>
                        <th style="padding: 16px; color: #666666;">Отзыв</th>
                        <th style="padding: 16px; color: #666666;">Статус</th>
                        <th style="padding: 16px; color: #666666;">Дата</th>
                        <th style="padding: 16px; color: #666666;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $review)
                    <tr style="border-bottom: 1px solid #F5F0F2;">
                        <td style="padding: 16px; color: #1A1A1A;">{{ $review->id }}</td>
                        <td style="padding: 16px;">
                            <div style="color: #1A1A1A; font-weight: 500;">{{ $review->author_name }}</div>
                            <small style="color: #888888;">{{ $review->author_email }}</small>
                        </td>
                        <td style="padding: 16px;">
                            <div style="display: flex; gap: 2px;">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg style="width: 16px; height: 16px; color: {{ $i <= $review->rating ? '#FFB800' : '#E8E8E8' }};" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                        </td>
                        <td style="padding: 16px; color: #4A4A4A; max-width: 300px;">{{ Str::limit($review->comment, 50) }}</td>
                        <td style="padding: 16px;">
                            @if($review->is_approved)
                                <span style="background: rgba(74,124,89,0.1); color: #4A7C59; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; border: 1px solid rgba(74,124,89,0.2);">Одобрен</span>
                            @else
                                <span style="background: rgba(229,57,53,0.1); color: #E53935; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; border: 1px solid rgba(229,57,53,0.2);">На модерации</span>
                            @endif
                        </td>
                        <td style="padding: 16px; color: #888888;">{{ $review->created_at->format('d.m.Y') }}</td>
                        <td style="padding: 16px;">
                            <a href="{{ route('admin.reviews.show', ['review' => $review->id]) }}" style="color: #D26F8B; text-decoration: none; font-weight: 500;">Подробнее</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div style="margin-top: 24px;">
        @if ($reviews->hasPages())
            <div style="display: flex; justify-content: center; gap: 8px; flex-wrap: wrap;">
                @if ($reviews->onFirstPage())
                    <span style="padding: 8px 16px; background: #FFFFFF; border: 1px solid #F0E4E8; border-radius: 8px; color: #888888; cursor: not-allowed;">← Назад</span>
                @else
                    <a href="{{ $reviews->previousPageUrl() }}" style="padding: 8px 16px; background: #FFFFFF; border: 1px solid #F0E4E8; border-radius: 8px; color: #D26F8B; text-decoration: none; transition: all 0.3s;">← Назад</a>
                @endif

                @php
                    $currentPage = $reviews->currentPage();
                    $lastPage = $reviews->lastPage();
                    $start = max(1, $currentPage - 2);
                    $end = min($lastPage, $currentPage + 2);
                @endphp

                @if ($start > 1)
                    <a href="{{ $reviews->url(1) }}" style="padding: 8px 16px; background: #FFFFFF; border: 1px solid #F0E4E8; border-radius: 8px; color: #1A1A1A; text-decoration: none; transition: all 0.3s;">1</a>
                    @if ($start > 2)
                        <span style="padding: 8px 16px; color: #888888;">...</span>
                    @endif
                @endif

                @for ($i = $start; $i <= $end; $i++)
                    @if ($i == $currentPage)
                        <span style="padding: 8px 16px; background: #D26F8B; color: #FFFFFF; border-radius: 8px; font-weight: 600;">{{ $i }}</span>
                    @else
                        <a href="{{ $reviews->url($i) }}" style="padding: 8px 16px; background: #FFFFFF; border: 1px solid #F0E4E8; border-radius: 8px; color: #1A1A1A; text-decoration: none; transition: all 0.3s;">{{ $i }}</a>
                    @endif
                @endfor

                @if ($end < $lastPage)
                    @if ($end < $lastPage - 1)
                        <span style="padding: 8px 16px; color: #888888;">...</span>
                    @endif
                    <a href="{{ $reviews->url($lastPage) }}" style="padding: 8px 16px; background: #FFFFFF; border: 1px solid #F0E4E8; border-radius: 8px; color: #1A1A1A; text-decoration: none; transition: all 0.3s;">{{ $lastPage }}</a>
                @endif

                @if ($reviews->hasMorePages())
                    <a href="{{ $reviews->nextPageUrl() }}" style="padding: 8px 16px; background: #FFFFFF; border: 1px solid #F0E4E8; border-radius: 8px; color: #D26F8B; text-decoration: none; transition: all 0.3s;">Вперед →</a>
                @else
                    <span style="padding: 8px 16px; background: #FFFFFF; border: 1px solid #F0E4E8; border-radius: 8px; color: #888888; cursor: not-allowed;">Вперед →</span>
                @endif
            </div>
        @endif
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
        th, td {
            padding: 12px !important;
            font-size: 0.8rem;
        }
    }
    
    a[href*="admin/reviews"]:hover {
        color: #E89BB3 !important;
    }
</style>
@endsection