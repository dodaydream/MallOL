<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Cart\BulkDestroyCart;
use App\Http\Requests\Admin\Cart\DestroyCart;
use App\Http\Requests\Admin\Cart\IndexCart;
use App\Http\Requests\Admin\Cart\StoreCart;
use App\Http\Requests\Admin\Cart\UpdateCart;
use App\Models\Cart;
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

class CartsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexCart $request
     * @return array|Factory|View
     */
    public function index(IndexCart $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Cart::class)
            ->modifyQuery(function ($query) use ($request) {
                $query->where('user_id', $request->user()->id);
            })->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'sku', 'inventory_id', 'user_id', 'qty'],

            // set columns to searchIn
            ['id', 'sku', 'qty'],

            function ($query) use ($request) {
                $query->with('inventory.product');
            }
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.cart.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.cart.create');

        return view('admin.cart.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCart $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreCart $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();
        $userId = $request->user()->id;

        $sanitized['user_id'] = $userId;

        // Store the Cart
        $cart = Cart::create($sanitized);

        if ($request->ajax()) {
            return $cart; 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Cart $cart
     * @throws AuthorizationException
     * @return void
     */
    public function show(Cart $cart)
    {
        $this->authorize('admin.cart.show', $cart);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Cart $cart
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Cart $cart)
    {
        $this->authorize('admin.cart.edit', $cart);


        return view('admin.cart.edit', [
            'cart' => $cart,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCart $request
     * @param Cart $cart
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateCart $request, Cart $cart)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Cart
        $cart->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/carts'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/carts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyCart $request
     * @param Cart $cart
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyCart $request, Cart $cart)
    {
        $cart->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyCart $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyCart $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Cart::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
