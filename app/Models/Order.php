<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'phone',
        'address',
        'city',
        'street',
        'house',
        'entrance',
        'door_code',
        'floor',
        'apartment',
        'address_comment',
        'delivery_date',      // ← ДОБАВЛЕНО
        'delivery_time',      // ← ДОБАВЛЕНО
        'comment',
        'subtotal',
        'discount_amount',
        'total_amount',
        'status',
        'payment_status',
        'payment_id',
        'promocode_id',
    ];
    
    protected $casts = [
        'total_amount' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'delivery_date' => 'date',  // ← ДОБАВЛЕНО
    ];
    
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function promocode()
    {
        return $this->belongsTo(Promocode::class);
    }
}