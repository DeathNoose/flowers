<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Flower;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class RecommendationService
{
    /**
     * Получить рекомендации для пользователя
     *
     * @param int|null $userId ID пользователя (если null - гость)
     * @param int $limit Количество рекомендаций
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecommendations($userId, $limit = 8)
    {
        // Если пользователь не авторизован - показываем популярные товары
        if (!$userId) {
            return $this->getPopularProducts($limit);
        }
        
        // Получаем категории, которые пользователь покупал
        $purchasedCategories = $this->getUserPurchasedCategories($userId);
        
        // Получаем ID товаров, которые пользователь уже покупал
        $purchasedProductIds = $this->getUserPurchasedProductIds($userId);
        
        // Если пользователь ничего не покупал - показываем популярные товары
        if ($purchasedCategories->isEmpty()) {
            return $this->getPopularProducts($limit);
        }
        
        // Рекомендуем товары из тех же категорий, исключая купленные
        $recommendations = Flower::whereIn('category_id', $purchasedCategories)
            ->whereNotIn('id', $purchasedProductIds)
            ->where('in_stock', true)
            ->limit($limit)
            ->get();  // ИСПРАВЛЕНО: убрана сортировка по quantity
        
        // Если рекомендаций недостаточно, добавляем популярные товары
        if ($recommendations->count() < $limit) {
            $additional = $this->getPopularProducts($limit - $recommendations->count(), $purchasedProductIds);
            $recommendations = $recommendations->concat($additional);
        }
        
        return $recommendations;
    }
    
    /**
     * Получить рекомендации для карточки товара ("С этим товаром покупают")
     *
     * @param int $productId ID текущего товара
     * @param int $limit Количество рекомендаций
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRelatedProducts($productId, $limit = 4)
    {
        $currentProduct = Flower::find($productId);
        
        if (!$currentProduct) {
            return collect();
        }
        
        // Находим товары из той же категории, исключая текущий
        $related = Flower::where('category_id', $currentProduct->category_id)
            ->where('id', '!=', $productId)
            ->where('in_stock', true)
            ->inRandomOrder()
            ->limit($limit)
            ->get();
        
        // Если в категории мало товаров, добавляем популярные
        if ($related->count() < $limit) {
            $additional = $this->getPopularProducts($limit - $related->count(), [$productId]);
            $related = $related->concat($additional);
        }
        
        return $related;
    }
    
    /**
     * Получить популярные товары
     *
     * @param int $limit Количество товаров
     * @param array $excludeIds ID товаров для исключения
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPopularProducts($limit = 8, $excludeIds = [])
    {
        $query = Flower::where('in_stock', true);
        
        if (!empty($excludeIds)) {
            $query->whereNotIn('id', $excludeIds);
        }
        
        // Получаем ID самых продаваемых товаров
        $popularIds = OrderItem::select('flower_id')
            ->selectRaw('SUM(quantity) as total_sold')
            ->groupBy('flower_id')
            ->orderByDesc('total_sold')
            ->limit($limit)
            ->pluck('flower_id')
            ->toArray();
        
        if (!empty($popularIds)) {
            // ИСПРАВЛЕНО: сортируем по порядку ID из массива popularIds
            $orderBy = implode(',', $popularIds);
            $query->orderByRaw("FIELD(id, {$orderBy}) DESC");
        } else {
            // ИСПРАВЛЕНО: вместо quantity используем created_at или id
            $query->orderBy('created_at', 'desc');
        }
        
        return $query->limit($limit)->get();
    }
    
    /**
     * Получить категории, которые пользователь покупал чаще всего
     *
     * @param int $userId
     * @return \Illuminate\Support\Collection
     */
    private function getUserPurchasedCategories($userId)
    {
        return OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('flowers', 'order_items.flower_id', '=', 'flowers.id')
            ->where('orders.user_id', $userId)
            ->where('orders.status', 'completed')
            ->select('flowers.category_id', DB::raw('COUNT(*) as purchase_count'))
            ->groupBy('flowers.category_id')
            ->orderByDesc('purchase_count')
            ->pluck('flowers.category_id');
    }
    
    /**
     * Получить ID товаров, которые пользователь уже покупал
     *
     * @param int $userId
     * @return array
     */
    private function getUserPurchasedProductIds($userId)
    {
        return OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.user_id', $userId)
            ->where('orders.status', 'completed')
            ->pluck('order_items.flower_id')
            ->unique()
            ->toArray();
    }
}