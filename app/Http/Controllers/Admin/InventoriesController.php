<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Inventory\BulkDestroyInventory;
use App\Http\Requests\Admin\Inventory\DestroyInventory;
use App\Http\Requests\Admin\Inventory\IndexInventory;
use App\Http\Requests\Admin\Inventory\StoreInventory;
use App\Http\Requests\Admin\Inventory\UpdateInventory;
use App\Models\Inventory;
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

class InventoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexInventory $request
     * @return array|Factory|View
     */
    public function index(IndexInventory $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Inventory::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'product_id', 'product_attr', 'sku', 'qty', 'shelf'],

            // set columns to searchIn
            ['id', 'product_attr', 'sku', 'qty', 'shelf']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.inventory.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.inventory.create');

        return view('admin.inventory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreInventory $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreInventory $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Inventory
        $inventory = Inventory::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/inventories'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/inventories');
    }

    /**
     * Display the specified resource.
     *
     * @param Inventory $inventory
     * @throws AuthorizationException
     * @return void
     */
    public function show(Inventory $inventory)
    {
        $this->authorize('admin.inventory.show', $inventory);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Inventory $inventory
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Inventory $inventory)
    {
        $this->authorize('admin.inventory.edit', $inventory);


        return view('admin.inventory.edit', [
            'inventory' => $inventory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateInventory $request
     * @param Inventory $inventory
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateInventory $request, Inventory $inventory)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Inventory
        $inventory->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/inventories'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/inventories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyInventory $request
     * @param Inventory $inventory
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyInventory $request, Inventory $inventory)
    {
        $inventory->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyInventory $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyInventory $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Inventory::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
