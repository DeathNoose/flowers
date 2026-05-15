<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use App\Services\RecommendationService;

class HomeController extends Controller
{
    protected $recommendationService;
    
    public function __construct(RecommendationService $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }
    
    public function index()
    {
        // ИСПРАВЛЕНО: убрана сортировка по quantity, используем created_at
        $popularFlowers = Flower::where('in_stock', true)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        
        // Получаем рекомендации для авторизованного пользователя
        $userId = auth()->id();
        $recommendations = $this->recommendationService->getRecommendations($userId, 6);
        
        return view('home', compact('popularFlowers', 'recommendations'));
    }
}