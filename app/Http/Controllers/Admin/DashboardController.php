<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Reports\BestSaleReport;

class DashboardController extends Controller
{
    public function index()
    {
        $bestSaleReport = new BestSaleReport();
        $bestSaleReport->run();
        return view('admin.dashboard', [
            'bestSaleReport' => $bestSaleReport
        ]);
    }
}
