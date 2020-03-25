<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'price',
        'total_price',
        'qty',
        'inventory_id',
        'order_id',
    ];
    
    
    protected $dates = [
    
    ];

    public $timestamps = false;
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/order-items/'.$this->getKey());
    }

    public static function fromCart(Cart $cart, $order_id)
    {

        $item = new OrderItem;
        // TODO implement promote price
        $item->price = $cart->inventory->product->price;
        $item->qty = $cart->qty;
        $item->total_price = $item->price * $item->qty;
        $item->inventory_id = $cart->inventory_id;
        $item->order_id = $order_id;

        return $item;
    }
}
