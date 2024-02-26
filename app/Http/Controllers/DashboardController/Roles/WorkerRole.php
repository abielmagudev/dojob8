<?php 

namespace App\Http\Controllers\DashboardController\Roles;

use Illuminate\Http\Request;

class WorkerRole
{
    public static function response(Request $request)
    {
        return view('dashboard.worker.index', compact('request'));
    }
}
