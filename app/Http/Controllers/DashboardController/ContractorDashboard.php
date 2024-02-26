<?php 

namespace App\Http\Controllers\DashboardController;

use Illuminate\Http\Request;

class ContractorDashboard
{
    public static function response(Request $request)
    {
        return view('dashboard.contractor.index', compact('request'));
    }
}
