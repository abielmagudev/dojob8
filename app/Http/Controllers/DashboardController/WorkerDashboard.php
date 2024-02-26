<?php 

namespace App\Http\Controllers\DashboardController;

use Illuminate\Http\Request;

class WorkerDashboard
{
    public static function response(Request $request)
    {
        return view('dashboard.worker.index', compact('request'));
    }
}
