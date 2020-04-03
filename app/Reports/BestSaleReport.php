<?php

namespace App\Reports;

use App\Models\DateDimension;
use App\Models\Order;
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
            Order::where('orders.created_at', '<', $this->params['ends'])
                ->where('orders.created_at', '>', $this->params['starts'])
                ->join('order_items', 'order_items.order_id', '=', 'orders.id')
                ->join('inventories', 'inventories.id', '=', 'order_items.inventory_id')
                ->join('products', 'products.id', '=', 'inventories.product_id')
                ->groupBy('products.id')
                ->select(DB::raw('sum(order_items.total_price) as total'), 'product_id', 'products.name')
                ->orderBy('total', 'desc')
                ->limit(10)
        )->pipe($this->dataStore("best_profit_products")); ;

        $this->src('elo')->query(
            Order::where('orders.created_at', '<', $this->params['ends'])
                ->where('orders.created_at', '>', $this->params['starts'])
                ->join('order_items', 'order_items.order_id', '=', 'orders.id')
                ->join('inventories', 'inventories.id', '=', 'order_items.inventory_id')
                ->join('products', 'products.id', '=', 'inventories.product_id')
                ->groupBy('products.id', 'order_items.qty')
                ->select(DB::raw('count(*) * order_items.qty as purchase'), 'product_id', 'products.name')
                ->orderBy('purchase', 'desc')
                ->limit(10)
        )->pipe($this->dataStore("best_sale_products")); ;

        $this->src('elo')->query(
            DateDimension::where('date', '<', $this->params['ends'])
                ->where('date', '>', $this->params['starts'])
                ->leftJoin('orders', 'date_dimensions.date', '=', DB::raw('date(orders.created_at)'))
                ->leftJoin('order_items', 'order_items.order_id', '=', 'orders.id')
                ->select(DB::raw('sum(order_items.total_price) as total, date'))
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->limit(30)
        )->pipe($this->dataStore("daily_sales_trend")); ;
    }
}