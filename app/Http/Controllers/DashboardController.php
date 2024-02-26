<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DashboardController\DashboardManager;
use App\Http\Controllers\DashboardController\StatisticalDataGenerator;
use App\Http\Controllers\Kernel\ScheduleRange;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $role = $user->getRoleNames()[0];

        return DashboardManager::responseByRole($role, $request);
    }
}
