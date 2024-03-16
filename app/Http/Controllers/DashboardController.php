<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DashboardController\Responses\AdminResponse;
use App\Http\Controllers\DashboardController\Responses\AgencyResponse;
use App\Http\Controllers\DashboardController\Responses\AssessorResponse;
use App\Http\Controllers\DashboardController\Responses\ContractorResponse;
use App\Http\Controllers\DashboardController\Responses\CrewMemberResponse;
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
        abort_if(! $this->collectionRoleResponses()->has($role), 500);

        return $this->collectionRoleResponses()->get($role);
    }

    private function collectionRoleResponses()
    {
        return collect([
            'SuperAdmin' => AdminResponse::class,
            'administrator' => AdminResponse::class,
            'manager' => AdminResponse::class,
            'coordinator' => AdminResponse::class,
            'payments' => AdminResponse::class,
            'assessor' => AssessorResponse::class,
            'crew-member' => CrewMemberResponse::class,
            'contractor' => ContractorResponse::class,
            'agency' => AgencyResponse::class,
        ]);
    }
}
