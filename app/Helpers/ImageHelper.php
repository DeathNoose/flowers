<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    public static function getFlowerImage($imagePath)
    {
        // Если путь пустой
        if (empty($imagePath)) {
            return asset('img/placeholder.png');
        }
        
        // Если это уже полный URL
        if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
            return $imagePath;
        }
        
        // Если путь начинается с '/storage/'
        if (str_starts_with($imagePath, '/storage/')) {
            return asset($imagePath);
        }
        
        // Если путь начинается с 'storage/'
        if (str_starts_with($imagePath, 'storage/')) {
            return asset($imagePath);
        }
        
        // Если путь начинается с 'products/'
        if (str_starts_with($imagePath, 'products/')) {
            return Storage::url($imagePath);
        }
        
        // Для любых других путей - пробуем как есть
        return asset($imagePath);
    }
}