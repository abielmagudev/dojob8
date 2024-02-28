<?php

namespace App\Http\Controllers\WorkOrderController\Index;

use App\Http\Controllers\WorkOrderController\Index\Data\AdminUser;
use App\Http\Controllers\WorkOrderController\Index\Data\AgencyUser;
use App\Http\Controllers\WorkOrderController\Index\Data\AssessorUser;
use App\Http\Controllers\WorkOrderController\Index\Data\ContractorUser;
use App\Http\Controllers\WorkOrderController\Index\Data\WorkerUser;
use Illuminate\Http\Request;

class AuthDataRetriever
{
    public static $roles_retrievers = [
        'agency' => AgencyUser::class,
        'assessor' => AssessorUser::class,
        'contractor' => ContractorUser::class,
        'worker' => WorkerUser::class,
    ];

    public static function get(Request $request)
    {
        $retriever = AdminUser::class;

        if( auth()->user()->hasNonAdminRole() ) {
            $retriever = self::collectionRolesRetrieviers()->get( auth()->user()->role_name );
        }

        return app($retriever)->data($request);
    }

    public static function collectionRolesRetrieviers()
    {
        return collect( self::$roles_retrievers );
    }
}
