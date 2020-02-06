<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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

        return view('checkout', ['data' => $data]);
    }
}
