<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductView extends Model
{
    protected $fillable = [
        'product_id', 'user_id', 'session_id', 'ip_address'
    ];
    
    public function product()
    {
        return $this->belongsTo(Flower::class, 'product_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}