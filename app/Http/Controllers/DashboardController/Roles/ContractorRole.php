<?php 

namespace App\Http\Controllers\DashboardController\Roles;

use Illuminate\Http\Request;

class ContractorRole
{
    public static function response(Request $request)
    {
        return view('dashboard.contractor.index', compact('request'));
    }
}
