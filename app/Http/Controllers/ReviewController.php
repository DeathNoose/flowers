<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::where('is_approved', true)
            ->where('is_visible', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        $averageRating = Review::where('is_approved', true)
            ->where('is_visible', true)
            ->avg('rating');
        
        $totalReviews = Review::where('is_approved', true)
            ->where('is_visible', true)
            ->count();
        
        $ratingDistribution = [
            5 => Review::where('rating', 5)->where('is_approved', true)->count(),
            4 => Review::where('rating', 4)->where('is_approved', true)->count(),
            3 => Review::where('rating', 3)->where('is_approved', true)->count(),
            2 => Review::where('rating', 2)->where('is_approved', true)->count(),
            1 => Review::where('rating', 1)->where('is_approved', true)->count(),
        ];
        
        return view('reviews.index', compact('reviews', 'averageRating', 'totalReviews', 'ratingDistribution'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'author_name' => 'required|string|max:255|regex:/^[а-яА-ЯёЁa-zA-Z\s\-]+$/u',
            'author_email' => 'nullable|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:2000',
        ], [
            'author_name.required' => 'Пожалуйста, укажите ваше имя',
            'author_name.regex' => 'Имя может содержать только буквы, пробелы и дефисы',
            'rating.required' => 'Пожалуйста, оцените нашу работу',
            'rating.min' => 'Рейтинг должен быть от 1 до 5',
            'rating.max' => 'Рейтинг должен быть от 1 до 5',
            'comment.required' => 'Пожалуйста, напишите ваш отзыв',
            'comment.min' => 'Отзыв должен содержать не менее 10 символов',
            'comment.max' => 'Отзыв не должен превышать 2000 символов',
        ]);

        if ($validator->fails()) {
            return redirect()->route('reviews.index')
                ->withErrors($validator)
                ->withInput();
        }

        Review::create([
            'user_id' => auth()->id(),
            'author_name' => $request->author_name,
            'author_email' => $request->author_email,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => false,
            'is_visible' => true,
        ]);

        return redirect()->route('reviews.index')
            ->with('success', 'Спасибо за ваш отзыв! Он будет опубликован после проверки модератором.');
    }
}