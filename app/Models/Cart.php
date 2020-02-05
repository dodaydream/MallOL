<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'sku',
        'inventory_id',
        'user_id',
        'qty',
    ];
    
    
    protected $dates = [
    
    ];
    public $timestamps = false;
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/carts/'.$this->getKey());
    }

    public function inventory() {
        return $this->belongsTo(Inventory::class);
    }
}
