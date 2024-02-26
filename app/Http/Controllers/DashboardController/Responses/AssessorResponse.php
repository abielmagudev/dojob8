<?php 

namespace App\Http\Controllers\DashboardController\Responses;

use Illuminate\Http\Request;

class AssessorResponse
{
    public static function response(Request $request)
    {
        return view('dashboard.assessor.index', compact('request'));
    }
}
