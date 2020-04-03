<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Reports\BestSaleReport;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $ends = Carbon::now();
        $start = Carbon::now()->sub('30 days');

        if ($request->has('range')) {
            $range = $request->query('range');
            $date = explode(' to ', $range);
            $start = Carbon::create($date[0]);
            $ends = Carbon::create($date[1]);
        }

        $bestSaleReport = new BestSaleReport([
            'starts' => $start,
            'ends' => $ends
        ]);

        $bestSaleReport->run();
        return view('admin.dashboard', [
            'bestSaleReport' => $bestSaleReport,
        ]);
    }
}
