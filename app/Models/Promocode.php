<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    protected $fillable = [
        'code', 'type', 'value', 'min_order_amount',
        'usage_limit', 'used_count', 'expires_at', 'is_active', 'description'
    ];

    protected $casts = [
        'expires_at' => 'date',
        'is_active' => 'boolean',
        'min_order_amount' => 'decimal:2',
        'value' => 'decimal:2'
    ];

    public function usages()
    {
        return $this->hasMany(PromocodeUsage::class);
    }

    public function isValid($userId = null)
    {
        if (!$this->is_active) {
            return false;
        }

        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        if ($this->usage_limit && $this->used_count >= $this->usage_limit) {
            return false;
        }

        if ($userId && $this->isUsedByUser($userId)) {
            return false;
        }

        return true;
    }

    public function isUsedByUser($userId)
    {
        return $this->usages()->where('user_id', $userId)->exists();
    }
}