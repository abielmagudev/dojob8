<?php

namespace App\Http\Controllers\WorkOrderController\Index;

use App\Http\Controllers\WorkOrderController\Index\Data\ManagementLoader;
use App\Http\Controllers\WorkOrderController\Index\Data\AssessorLoader;
use App\Http\Controllers\WorkOrderController\Index\Data\ContractorLoader;
use App\Http\Controllers\WorkOrderController\Index\Data\CrewMemberLoader;

class IndexDataLoadersContainer
{
    const LOADER_NOT_FOUND = false;

    protected static $cache;

    public static $roles_loaders = [
        'administrator' => ManagementLoader::class,
        'assessor' => AssessorLoader::class,
        'contractor' => ContractorLoader::class,
        'coordinator' => ManagementLoader::class,
        'crew-member' => CrewMemberLoader::class,
        'manager' => ManagementLoader::class,
        'SuperAdmin' => ManagementLoader::class,
    ];

    public static function all()
    {
        if( is_null(self::$cache) ) {
            self::$cache = collect( self::$roles_loaders );
        }
        
        return self::$cache;
    }

    public static function has(string $role)
    {
        return self::all()->has($role);
    }

    public static function get(string $role)
    {
        return self::all()->get($role);
    }
}
