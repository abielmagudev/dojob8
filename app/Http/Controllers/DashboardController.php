<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Inspection;
use App\Models\Contractor;
use App\Models\Job;
use App\Models\WorkOrder;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $work_orders = WorkOrder::whereYear('scheduled_date', date('Y'))
        ->orderBy('scheduled_date', 'desc')
        ->get();

        return view('dashboard.index', [
            'all_statuses_work_order' => WorkOrder::getAllStatuses(),
            'clients' => Client::all(),
            'contractors' => Contractor::all(),
            'jobs' => Job::withTrashed()->get(),
            'unfinished_work_orders' => WorkOrder::filterByUnfinishedStatus($work_orders),
            'user' => User::all(),
            'work_orders' => $work_orders,
            'inspections' => Inspection::with('inspector')->get(),
        ]);
    }
}
