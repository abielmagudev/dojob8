<?php

namespace App\Http\Controllers\DashboardController\Roles;

use Illuminate\Http\Request;

class AgencyRole
{
    public static function response(Request $request)
    {
        return view('dashboard.agency.index', compact('request'));
    }
}
