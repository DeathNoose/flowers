<?php

namespace App\Models;

use Illuminate\Support\Facades\Session;

class Cart
{
    private $items = [];
    
    public function __construct()
    {
        $this->items = Session::get('cart', []);
    }
    
    public function add($flowerId, $name, $price, $image = null, $quantity = 1)
    {
        if (isset($this->items[$flowerId])) {
            $this->items[$flowerId]['quantity'] += $quantity;
            $this->items[$flowerId]['total'] = $this->items[$flowerId]['price'] * $this->items[$flowerId]['quantity'];
        } else {
            $this->items[$flowerId] = [
                'id' => $flowerId,
                'name' => $name,
                'price' => $price,
                'image' => $image,
                'quantity' => $quantity,
                'total' => $price * $quantity
            ];
        }
        
        Session::put('cart', $this->items);
        return $this->items;
    }
    
    public function update($flowerId, $quantity)
    {
        if (isset($this->items[$flowerId])) {
            if ($quantity <= 0) {
                $this->remove($flowerId);
            } else {
                $this->items[$flowerId]['quantity'] = $quantity;
                $this->items[$flowerId]['total'] = $this->items[$flowerId]['price'] * $quantity;
                Session::put('cart', $this->items);
            }
        }
        return $this->items;
    }
    
    public function remove($flowerId)
    {
        if (isset($this->items[$flowerId])) {
            unset($this->items[$flowerId]);
            Session::put('cart', $this->items);
        }
        return $this->items;
    }
    
    public function clear()
    {
        Session::forget('cart');
        $this->items = [];
    }
    
    public function getItems()
    {
        return $this->items;
    }
    
    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['total'];
        }
        return $total;
    }
    
    public function getCount()
    {
        $count = 0;
        foreach ($this->items as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }
}