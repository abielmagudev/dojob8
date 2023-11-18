<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Intermediary;
use App\Models\Job;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard.index', [
            'clients' => Client::all(),
            'intermediaries' => Intermediary::all(),
            'orders' => Order::whereYear('scheduled_date', date('Y'))->orderBy('scheduled_date', 'desc')->get(),
            'user' => User::all(),
            'jobs' => Job::all(),
        ]);
    }
}
