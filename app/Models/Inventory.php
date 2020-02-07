<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'product_id',
        'product_attr',
        'sku',
        'qty',
        'shelf',
    
    ];
    
    protected $dates = [
    
    ];

    public $timestamps = false;
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/inventories/'.$this->getKey());
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
