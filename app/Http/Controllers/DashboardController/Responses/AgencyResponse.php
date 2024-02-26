<?php

namespace App\Http\Controllers\DashboardController\Responses;

use Illuminate\Http\Request;

class AgencyResponse
{
    public static function response(Request $request)
    {
        return view('dashboard.agency.index', compact('request'));
    }
}
