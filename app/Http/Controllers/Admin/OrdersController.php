<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\BulkDestroyOrder;
use App\Http\Requests\Admin\Order\DestroyOrder;
use App\Http\Requests\Admin\Order\IndexOrder;
use App\Http\Requests\Admin\Order\StoreOrder;
use App\Http\Requests\Admin\Order\UpdateOrder;
use App\Models\Order;
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

class OrdersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexOrder $request
     * @return array|Factory|View
     */
    public function index(IndexOrder $request)
    {
        if (!$request->has('orderBy')) {
            $request->merge(['orderBy' => 'created_at', 'orderDirection' => 'desc']);
        }

        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Order::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'status', 'po_number', 'completed_at', 'total_price', 'user_id', 'created_at'],

            // set columns to searchIn
            ['id', 'status', 'po_number', 'completed_at', 'created_at'],

            function ($query) {
                $query->with(['user']);
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

        return view('admin.order.index', ['data' => $data]);
    }

    public function indexUser(IndexOrder $request)
    {
        if (!$request->has('orderBy')) {
            $request->merge(['orderBy' => 'created_at', 'orderDirection' => 'desc']);
        }

        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Order::class)->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            ['id', 'status', 'po_number', 'completed_at', 'total_price', 'created_at'],

            // set columns to searchIn
            ['status', 'po_number', 'completed_at', 'created_at'],

            function ($query) use ($request){
                $query->where('user_id', $request->user()->id);
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

        return view('admin.order.user-index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.order.create');

        return view('admin.order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrder $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreOrder $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Order
        $order = Order::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/orders'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/orders');
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @throws AuthorizationException
     * @return void
     */
    public function show(Order $order)
    {
        $this->authorize('admin.order.show', $order);

        return view('admin.order.show', [
            'order' => $order,
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @throws AuthorizationException
     * @return void
     */
    public function userShow(Order $order)
    {
        return view('admin.order.user-show', [
            'order' => $order,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Order $order)
    {
        $this->authorize('admin.order.edit', $order);

        return view('admin.order.edit', [
            'order' => $order,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrder $request
     * @param Order $order
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateOrder $request, Order $order)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Order
        $order->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/orders'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyOrder $request
     * @param Order $order
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyOrder $request, Order $order)
    {
        $order->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyOrder $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyOrder $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Order::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
