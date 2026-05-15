<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Flower extends Model
{
    protected $table = 'flowers';
    
    protected $fillable = [
        'name', 'slug', 'description', 'price', 'category_id', 
        'image_path', 'in_stock', 'quantity'
    ];
    
    // Автоматически генерировать slug при создании
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($flower) {
            if (empty($flower->slug)) {
                $flower->slug = Str::slug($flower->name);
            }
        });
    }
    
    // Связь с категорией
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    // Связь с дополнительными изображениями
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'flower_id')->orderBy('sort_order');
    }
    
    // Получить все изображения
    public function getAllImages()
    {
        $images = collect();
        
        if ($this->image_path) {
            $images->push((object)[
                'image_path' => $this->image_path,
                'is_primary' => true
            ]);
        }
        
        foreach ($this->images as $img) {
            $images->push((object)[
                'image_path' => $img->image_path,
                'is_primary' => false
            ]);
        }
        
        return $images;
    }
}