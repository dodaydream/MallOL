<?php

namespace App\Reports;

use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use koolreport\KoolReport;
use koolreport\laravel\Eloquent;
use koolreport\laravel\Friendship;

class BestSaleReport extends KoolReport
{
    use Friendship;

    function settings()
    {
        return [
            "dataSources" => [
                "elo" => [
                    "class"=> Eloquent::class
                ]
            ]
        ];
    }

    function setup()
    {
        $this->src('elo')->query(
            OrderItem::where('created_at', '<', Carbon::now())
                ->where('created_at', '>', Carbon::now()->sub('30 days'))
                ->join('inventories', 'inventories.id', '=', 'order_items.inventory_id')
                ->join('products', 'products.id', '=', 'inventories.product_id')
                ->groupBy('products.id')
                ->select(DB::raw('sum(order_items.total_price) as total'), 'product_id', 'products.name')
                ->orderBy('total', 'desc')
                ->limit(10)
        )->pipe($this->dataStore("best_profit_products")); ;

        $this->src('elo')->query(
            OrderItem::where('created_at', '<', Carbon::now())
                ->where('created_at', '>', Carbon::now()->sub('30 days'))
                ->join('inventories', 'inventories.id', '=', 'order_items.inventory_id')
                ->join('products', 'products.id', '=', 'inventories.product_id')
                ->groupBy('products.id', 'order_items.qty')
                ->select(DB::raw('count(*) * order_items.qty as purchase'), 'product_id', 'products.name')
                ->orderBy('purchase', 'desc')
                ->limit(10)
        )->pipe($this->dataStore("best_sale_products")); ;
    }
}