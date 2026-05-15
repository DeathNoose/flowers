<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'product_id', 'user_id', 'order_id', 'rating',
        'title', 'comment', 'images', 'is_approved',
        'helpful_count', 'unhelpful_count', 'admin_response', 'admin_response_at'
    ];
    
    protected $casts = [
        'images' => 'array',
        'is_approved' => 'boolean',
        'admin_response_at' => 'datetime'
    ];
    
    public function product()
    {
        return $this->belongsTo(Flower::class, 'product_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function helpful()
    {
        return $this->hasMany(ReviewHelpful::class);
    }
}