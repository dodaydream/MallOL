<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
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
use Illuminate\Http\Request;

class CheckoutController extends Controller
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
    public function checkout(Request $request)
    {
        // TODO: filter request
        // create and AdminListing instance for a specific model and
        $input = json_decode($request->input('ids'), true);

        $ids = array_map(
          function($value) { return (int) $value; },
          $input
        ); 

        $data = Cart::whereIn('id', $ids)
          ->with('inventory.product')->get();

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('checkout', ['data' => $data, 'ids' => $ids]);
    }

    public function checkout_success(Request $request)
    {
        $input = json_decode($request->input('ids'), true);

        $ids = array_map(
          function($value) { return (int) $value; },
          $input
        ); 

        DB::beginTransaction();

        try {
            $data = Cart::whereIn('id', $ids)
                ->with('inventory.product')->get();
            $user_id = $request->user()->id;

            $po_number = \Carbon\Carbon::now()->isoFormat('YYYYMMDDHHmmSSSSSS') . str_pad($user_id, 12, "0", STR_PAD_LEFT) . rand(1000, 9999);

            // Placehold total_price
            $order = Order::create([
                'po_number' => $po_number,
                'user_id' => $user_id,
                'total_price' => 0
            ]);

            $orderId = $order->id;

            $totalPrice = 0;
            $data->each(function ($item) use ($orderId, &$totalPrice) {
                $orderItem = OrderItem::fromCart($item, $orderId);
                $orderItem->save();
                $totalPrice += $orderItem->total_price;
                $item->delete();
            });

            $order->total_price = $totalPrice;
            $order->status = 'pending';
            $order->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        // TODO: transaction
        // TODO: delete from cart, as well as frontend

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('checkout_success', [
            'data' => $data,
            'order' => $order
        ]);

    }
}
