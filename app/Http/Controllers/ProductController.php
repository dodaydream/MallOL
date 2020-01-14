<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\Admin\Product\IndexProduct;
use Brackets\AdminListing\Facades\AdminListing;

class ProductController extends Controller
{
    /**
     * Show product details.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Product $product)
    {
        $product->load('inventories');

        return view('product.show', [
            'product' => $product
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexProduct $request
     * @return array|Factory|View
     */
    public function index(IndexProduct $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Product::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'spu', 'price', 'market_price', 'promote_price', 'is_on_sale', 'is_promote', 'description', 'category_id', 'brand_id'],

            // set columns to searchIn
            ['id', 'name', 'spu', 'description', 'details'],

            function ($query) use ($request) {
                $query->with(['category']);
                $query->with(['brand']);
                if($request->has('category')){
                    $query->whereIn('category', $request->get('category'));
                }
                if($request->has('brand')){
                    $query->whereIn('brand', $request->get('brand'));
                }
            }
        );

        // FIXME
        //$data = $data->map(function ($item) {
         //   $item['thumb'] = $item->getFirstMediaUrl('gallery', 'thumb_200');
          //  return $item;
        //});

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('product.index', ['data' => $data]);
    }
}
