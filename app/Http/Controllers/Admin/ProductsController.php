<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\BulkDestroyProduct;
use App\Http\Requests\Admin\Product\DestroyProduct;
use App\Http\Requests\Admin\Product\IndexProduct;
use App\Http\Requests\Admin\Product\StoreProduct;
use App\Http\Requests\Admin\Product\UpdateProduct;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProductsController extends Controller
{

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
                $query->with(['media']);
                if($request->has('category')){
                    $query->whereIn('category', $request->get('category'));
                }
                if($request->has('brand')){
                    $query->whereIn('brand', $request->get('brand'));
                }
            }
        );

        foreach ($data as &$item) {
            $item->thumb_url = $item->getFirstMediaUrl('gallery', 'thumb_200');
        }

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.product.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.product.create');

        return view('admin.product.create',[
            'categories' => Category::all(),
            'brands' => Brand::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProduct $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreProduct $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Product
        $product = Product::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/products'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/products');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @throws AuthorizationException
     * @return void
     */
    public function show(Product $product)
    {
        $this->authorize('admin.product.show', $product);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Product $product)
    {
        $this->authorize('admin.product.edit', $product);
        $product->load('inventories');


        return view('admin.product.edit', [
            'product' => $product,
            'categories' => Category::all(),
            'brands' => Brand::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProduct $request
     * @param Product $product
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateProduct $request, Product $product)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Product
        $product->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/products'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyProduct $request
     * @param Product $product
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyProduct $request, Product $product)
    {
        $product->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyProduct $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyProduct $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Product::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
