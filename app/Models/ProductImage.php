<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'flower_id', 'image_path', 'sort_order', 'is_primary'
    ];
    
    public function flower()
    {
        return $this->belongsTo(Flower::class, 'flower_id');
    }
}