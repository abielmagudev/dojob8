<?php 

namespace App\Http\Controllers\DashboardController\Responses;

use Illuminate\Http\Request;

class ContractorResponse
{
    public static function response(Request $request)
    {
        return view('dashboard.contractor.index', compact('request'));
    }
}
