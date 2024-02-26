<?php 

namespace App\Http\Controllers\DashboardController;

use Illuminate\Http\Request;

class AssessorDashboard
{
    public static function response(Request $request)
    {
        return view('dashboard.assessor.index', compact('request'));
    }
}
