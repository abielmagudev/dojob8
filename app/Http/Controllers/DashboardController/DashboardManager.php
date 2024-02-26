<?php 

namespace App\Http\Controllers\DashboardController;

use App\Http\Controllers\DashboardController\Roles\AdminRole;
use App\Http\Controllers\DashboardController\Roles\ContractorRole;
use App\Http\Controllers\DashboardController\Roles\WorkerRole;
use App\Http\Controllers\DashboardController\Roles\AgencyRole;
use Illuminate\Http\Request;

class DashboardManager
{
    public static $roles_classname_responses = [
        'SuperAdmin' => AdminRole::class,
        'administrator' => AdminRole::class,
        'manager' => AdminRole::class,
        'coordinator' => AdminRole::class,
        'worker' => WorkerRole::class,
        'payments' => AdminRole::class,
        'contractor' => ContractorRole::class,
        'agency' => AgencyRole::class,
    ];

    public static function collection()
    {
        return collect( self::$roles_classname_responses );
    }

    public static function getClassnameResponse(string $role)
    {
        abort_if(!self::collection()->has($role), 500);

        return self::collection()->get($role);
    }

    public static function responseByRole(string $role, Request $request)
    {
        $classame_response = self::getClassnameResponse($role);

        return app($classame_response)::response($request);
    }
}
