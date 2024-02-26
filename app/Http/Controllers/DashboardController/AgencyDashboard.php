<?php

namespace App\Http\Controllers\DashboardController;

use Illuminate\Http\Request;

class AgencyDashboard
{
    public static function response(Request $request)
    {
        return view('dashboard.agency.index', compact('request'));
    }
}
