<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::where('is_approved', true)
            ->where('is_visible', true);
        
        // Фильтр по рейтингу
        if ($request->filled('rating') && $request->rating != 'all') {
            $query->where('rating', $request->rating);
        }
        
        // Сортировка
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'highest':
                $query->orderBy('rating', 'desc');
                break;
            case 'lowest':
                $query->orderBy('rating', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
        
        $reviews = $query->paginate(10);
        
        $averageRating = Review::where('is_approved', true)
            ->where('is_visible', true)
            ->avg('rating');
        
        $totalReviews = Review::where('is_approved', true)
            ->where('is_visible', true)
            ->count();
        
        $ratingDistribution = [
            5 => Review::where('rating', 5)->where('is_approved', true)->where('is_visible', true)->count(),
            4 => Review::where('rating', 4)->where('is_approved', true)->where('is_visible', true)->count(),
            3 => Review::where('rating', 3)->where('is_approved', true)->where('is_visible', true)->count(),
            2 => Review::where('rating', 2)->where('is_approved', true)->where('is_visible', true)->count(),
            1 => Review::where('rating', 1)->where('is_approved', true)->where('is_visible', true)->count(),
        ];
        
        return view('reviews.index', compact('reviews', 'averageRating', 'totalReviews', 'ratingDistribution'));
    }

    public function store(Request $request)
    {
        // Валидация с русскими сообщениями об ошибках
        $validator = Validator::make($request->all(), [
            'author_name' => 'required|string|max:255|regex:/^[а-яА-ЯёЁa-zA-Z\s\-]+$/u',
            'author_email' => 'nullable|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:5000',  // ← ИСПРАВЛЕНО: nullable вместо required
        ], [
            // Русские сообщения об ошибках
            'author_name.required' => 'Пожалуйста, укажите ваше имя',
            'author_name.max' => 'Имя не должно превышать 255 символов',
            'author_name.regex' => 'Имя может содержать только буквы, пробелы и дефисы',
            'author_email.email' => 'Введите корректный email адрес (например: name@mail.ru)',
            'author_email.max' => 'Email не должен превышать 255 символов',
            'rating.required' => 'Пожалуйста, выберите оценку',
            'rating.integer' => 'Оценка должна быть целым числом',
            'rating.min' => 'Оценка должна быть от 1 до 5',
            'rating.max' => 'Оценка должна быть от 1 до 5',
            'comment.max' => 'Отзыв не должен превышать 5000 символов',
        ]);

        if ($validator->fails()) {
            return redirect()->route('reviews.index')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Пожалуйста, исправьте ошибки в форме');
        }

        // Создание отзыва
        Review::create([
            'user_id' => auth()->id(),
            'author_name' => $request->author_name,
            'author_email' => $request->author_email,
            'rating' => $request->rating,
            'comment' => $request->comment ?? null,  // Если сообщение пустое - сохраняем null
            'is_approved' => false,
            'is_visible' => true,
        ]);

        return redirect()->route('reviews.index')
            ->with('success', 'Спасибо за ваш отзыв! Он будет опубликован после проверки модератором.');
    }
}