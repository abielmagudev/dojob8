<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DashboardController\AdminDashboard;
use App\Http\Controllers\DashboardController\AgencyDashboard;
use App\Http\Controllers\DashboardController\AssessorDashboard;
use App\Http\Controllers\DashboardController\ContractorDashboard;
use App\Http\Controllers\DashboardController\WorkerDashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $role = (auth()->user())->getRoleNames()[0];

        $dashboard = $this->dashboardByRole($role);

        return app($dashboard)::response($request);
    }

    private function dashboardByRole($role)
    {
        abort_if(! $this->collectionRolesDashboards()->has($role), 500);

        return $this->collectionRolesDashboards()->get($role);
    }

    private function collectionRolesDashboards()
    {
        return collect([
            'SuperAdmin' => AdminDashboard::class,
            'administrator' => AdminDashboard::class,
            'manager' => AdminDashboard::class,
            'coordinator' => AdminDashboard::class,
            'payments' => AdminDashboard::class,
            'assessor' => AssessorDashboard::class,
            'worker' => WorkerDashboard::class,
            'contractor' => ContractorDashboard::class,
            'agency' => AgencyDashboard::class,
        ]);
    }
}
