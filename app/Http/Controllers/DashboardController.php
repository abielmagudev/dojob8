<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Intermediary;
use App\Models\Job;
use App\Models\WorkOrder;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard.index', [
            'clients' => Client::all(),
            'intermediaries' => Intermediary::all(),
            'work_orders' => WorkOrder::whereYear('scheduled_date', date('Y'))->orderBy('scheduled_date', 'desc')->get(),
            'work_orders_status' => WorkOrder::getStatusKeys(),
            'user' => User::all(),
            'jobs' => Job::withTrashed()->get(),
        ]);
    }
}
