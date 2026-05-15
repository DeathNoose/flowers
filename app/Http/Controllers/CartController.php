<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Flower;
use App\Models\Promocode;
use App\Models\PromocodeUsage;
use App\Services\RecommendationService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $recommendationService;
    
    public function __construct(RecommendationService $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }
    
    public function index()
    {
        $cart = new Cart();
        $items = $cart->getItems();
        $cartProductIds = array_keys($items);
        
        // Получаем рекомендации
        $recommendations = $this->recommendationService->getPopularProducts(4, $cartProductIds);
        
        // Получаем примененный промокод
        $appliedPromocode = session('applied_promocode');
        $discount = session('discount', 0);
        $subtotal = $cart->getTotal();
        $total = max(0, $subtotal - $discount);
        
        return view('cart.index', [
            'items' => $items,
            'subtotal' => $subtotal,
            'total' => $total,
            'count' => $cart->getCount(),
            'recommendations' => $recommendations,
            'appliedPromocode' => $appliedPromocode,
            'discount' => $discount
        ]);
    }
    
    /**
     * Применение промокода (только для авторизованных)
     */
    public function applyPromocode(Request $request)
    {
        try {
            // Проверка авторизации
            if (!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Промокоды доступны только авторизованным пользователям. Пожалуйста, войдите в аккаунт.'
                ]);
            }
            
            // Валидация входных данных
            $request->validate([
                'code' => 'required|string|max:50'
            ]);
            
            // Получаем корзину
            $cart = new Cart();
            $items = $cart->getItems();
            
            if (empty($items)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Корзина пуста. Добавьте товары перед применением промокода.'
                ]);
            }
            
            // Вычисляем сумму корзины
            $subtotal = 0;
            foreach ($items as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }
            
            // Ищем промокод
            $code = strtoupper(trim($request->code));
            $promocode = Promocode::where('code', $code)->first();
            
            if (!$promocode) {
                return response()->json([
                    'success' => false,
                    'message' => 'Промокод "' . $code . '" не найден'
                ]);
            }
            
            // Проверка активности
            if (!$promocode->is_active) {
                return response()->json([
                    'success' => false,
                    'message' => 'Промокод "' . $code . '" неактивен'
                ]);
            }
            
            // Проверка срока действия
            if ($promocode->expires_at && $promocode->expires_at < now()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Срок действия промокода "' . $code . '" истек ' . $promocode->expires_at->format('d.m.Y')
                ]);
            }
            
            // Проверка лимита использований
            if ($promocode->usage_limit && $promocode->used_count >= $promocode->usage_limit) {
                return response()->json([
                    'success' => false,
                    'message' => 'Промокод "' . $code . '" больше не действителен (лимит использований исчерпан)'
                ]);
            }
            
            // Проверка, использовал ли пользователь этот промокод
            $user = auth()->user();
            $alreadyUsed = PromocodeUsage::where('promocode_id', $promocode->id)
                ->where('user_id', $user->id)
                ->exists();
                
            if ($alreadyUsed) {
                return response()->json([
                    'success' => false,
                    'message' => 'Вы уже использовали промокод "' . $code . '"'
                ]);
            }
            
            // Проверка минимальной суммы заказа
            if ($subtotal < $promocode->min_order_amount) {
                return response()->json([
                    'success' => false,
                    'message' => 'Минимальная сумма заказа для этого промокода: ' . number_format($promocode->min_order_amount, 0, ',', ' ') . ' ₽'
                ]);
            }
            
            // Расчет скидки
            if ($promocode->type === 'percent') {
                $discount = round($subtotal * ($promocode->value / 100), 2);
            } else {
                $discount = min($promocode->value, $subtotal);
            }
            
            // Сохраняем в сессию
            session([
                'applied_promocode' => [
                    'id' => $promocode->id,
                    'code' => $promocode->code,
                    'type' => $promocode->type,
                    'value' => $promocode->value,
                    'discount' => $discount
                ],
                'discount' => $discount
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Промокод "' . $code . '" применен! Скидка: ' . number_format($discount, 0, ',', ' ') . ' ₽',
                'discount' => $discount,
                'total' => $subtotal - $discount,
                'subtotal' => $subtotal
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Введите код промокода'
            ]);
        } catch (\Exception $e) {
            // Логируем ошибку для отладки
            \Log::error('Promocode error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
            
            return response()->json([
                'success' => false,
                'message' => 'Произошла ошибка при проверке промокода. Пожалуйста, попробуйте позже.'
            ]);
        }
    }
    
    /**
     * Удаление промокода
     */
    public function removePromocode()
    {
        try {
            session()->forget(['applied_promocode', 'discount']);
            
            $cart = new Cart();
            $items = $cart->getItems();
            $total = 0;
            foreach ($items as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Промокод удален',
                'total' => $total
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при удалении промокода'
            ]);
        }
    }
    
    public function add(Request $request, Flower $flower)
    {
        try {
            $cart = new Cart();
            $quantity = $request->input('quantity', 1);
            
            $cart->add(
                $flower->id,
                $flower->name,
                $flower->price,
                $flower->image_path,
                $quantity
            );
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Товар добавлен в корзину',
                    'count' => $cart->getCount(),
                    'total' => $cart->getTotal(),
                    'items' => $cart->getItems()
                ]);
            }
            
            return redirect()->route('cart.index')->with('success', 'Товар добавлен в корзину');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function update(Request $request)
    {
        try {
            $cart = new Cart();
            $flowerId = $request->input('flower_id');
            $quantity = $request->input('quantity');
            
            if (!$flowerId || !$quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Неверные параметры'
                ], 400);
            }
            
            $cart->update($flowerId, $quantity);
            
            return response()->json([
                'success' => true,
                'items' => $cart->getItems(),
                'total' => $cart->getTotal(),
                'count' => $cart->getCount()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function remove(Request $request)
    {
        try {
            $cart = new Cart();
            $flowerId = $request->input('flower_id');
            
            if (!$flowerId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Не указан ID товара'
                ], 400);
            }
            
            $cart->remove($flowerId);
            
            return response()->json([
                'success' => true,
                'items' => $cart->getItems(),
                'total' => $cart->getTotal(),
                'count' => $cart->getCount()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function clear(Request $request)
    {
        try {
            $cart = new Cart();
            $cart->clear();
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Корзина очищена',
                    'count' => 0,
                    'total' => 0
                ]);
            }
            
            return redirect()->route('cart.index')->with('success', 'Корзина очищена');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка: ' . $e->getMessage()
            ], 500);
        }
    }
}