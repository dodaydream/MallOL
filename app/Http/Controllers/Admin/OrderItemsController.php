<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderItem\BulkDestroyOrderItem;
use App\Http\Requests\Admin\OrderItem\DestroyOrderItem;
use App\Http\Requests\Admin\OrderItem\IndexOrderItem;
use App\Http\Requests\Admin\OrderItem\StoreOrderItem;
use App\Http\Requests\Admin\OrderItem\UpdateOrderItem;
use App\Models\OrderItem;
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

class OrderItemsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexOrderItem $request
     * @return array|Factory|View
     */
    public function index(IndexOrderItem $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(OrderItem::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'price', 'total_price', 'qty', 'inventory_id', 'order_id'],

            // set columns to searchIn
            ['id'],

            function ($query) use ($request) {
                if (!$request->has('order_id')) {
                    abort(500, 'Server error'); 
                }

                $query->where('order_id', $request->input('order_id'));
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

        return view('admin.order-item.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.order-item.create');

        return view('admin.order-item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrderItem $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreOrderItem $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the OrderItem
        $orderItem = OrderItem::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/order-items'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/order-items');
    }

    /**
     * Display the specified resource.
     *
     * @param OrderItem $orderItem
     * @throws AuthorizationException
     * @return void
     */
    public function show(OrderItem $orderItem)
    {
        $this->authorize('admin.order-item.show', $orderItem);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param OrderItem $orderItem
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(OrderItem $orderItem)
    {
        $this->authorize('admin.order-item.edit', $orderItem);


        return view('admin.order-item.edit', [
            'orderItem' => $orderItem,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrderItem $request
     * @param OrderItem $orderItem
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateOrderItem $request, OrderItem $orderItem)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values OrderItem
        $orderItem->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/order-items'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/order-items');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyOrderItem $request
     * @param OrderItem $orderItem
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyOrderItem $request, OrderItem $orderItem)
    {
        $orderItem->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyOrderItem $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyOrderItem $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    OrderItem::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
