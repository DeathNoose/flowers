<?php

namespace App\Http\Controllers;

use App\Models\Promocode;
use Illuminate\Http\Request;

class PromocodeController extends Controller
{
    public function apply(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Промокоды доступны только авторизованным пользователям'
            ]);
        }
        
        $code = $request->input('code');
        $cartTotal = $this->getCartTotal();
        
        $promocode = Promocode::where('code', $code)
            ->where('expires_at', '>', now())
            ->whereDoesntHave('usages', function($query) {
                $query->where('user_id', auth()->id());
            })
            ->first();
        
        if (!$promocode) {
            return response()->json([
                'success' => false,
                'message' => 'Промокод недействителен или уже был использован'
            ]);
        }
        
        if ($cartTotal < $promocode->min_order_amount) {
            return response()->json([
                'success' => false,
                'message' => 'Минимальная сумма заказа для этого промокода: ' . $promocode->min_order_amount . ' ₽'
            ]);
        }
        
        $discount = 0;
        if ($promocode->type === 'percent') {
            $discount = $cartTotal * ($promocode->value / 100);
        } elseif ($promocode->type === 'fixed') {
            $discount = min($promocode->value, $cartTotal);
        }
        
        session(['promocode_applied' => $promocode->id, 'discount' => $discount]);
        
        return response()->json([
            'success' => true,
            'discount' => $discount,
            'total' => $cartTotal - $discount,
            'message' => 'Промокод применен! Скидка: ' . $discount . ' ₽'
        ]);
    }
}