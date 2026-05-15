<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use App\Models\Category;
use App\Services\RecommendationService;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    protected $recommendationService;
    
    // ИСПРАВЛЕНО: добавлен конструктор с внедрением зависимости
    public function __construct(RecommendationService $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }
    
    public function index(Request $request)
    {
        $query = Flower::with('category');
        
        // Фильтр по категории
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        // Фильтр по цене (от)
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        
        // Фильтр по цене (до)
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }
        
        // Фильтр по наличию
        if ($request->filled('in_stock')) {
            $query->where('in_stock', $request->in_stock);
        }
        
        // Сортировка
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }
        
        $flowers = $query->paginate(12)->withQueryString();
        $categories = Category::orderBy('name')->get();
        
        return view('catalog.index', compact('flowers', 'categories'));
    }

    public function show(Flower $flower)
    {
        // ИСПРАВЛЕНО: используем сервис рекомендаций
        $related = $this->recommendationService->getRelatedProducts($flower->id, 4);
        
        return view('catalog.show', compact('flower', 'related'));
    }
}