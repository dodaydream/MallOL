<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Show the application dashboard.
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
}
