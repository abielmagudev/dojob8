<?php

namespace App\Http\Controllers\WorkOrderController\Index;

use App\Http\Controllers\WorkOrderController\Index\Data\AdminLoader;
use App\Http\Controllers\WorkOrderController\Index\Data\AssessorLoader;
use App\Http\Controllers\WorkOrderController\Index\Data\ContractorLoader;
use App\Http\Controllers\WorkOrderController\Index\Data\WorkerLoader;

class DataLoadersContainer
{
    const LOADER_NOT_FOUND = false;

    public static $admin_loaders = [
        'SuperAdmin',
        'administrator',
        'manager',
        'coordinator',
    ];

    public static function get(string $loader)
    {
        if( in_array($loader, self::$admin_loaders) ) {
            return AdminLoader::class;
        }

        if( $loader == 'assessor' ) {
            return AssessorLoader::class;
        }

        if( $loader == 'contractor' ) {
            return ContractorLoader::class;
        }

        if( $loader == 'worker' ) {
            return WorkerLoader::class;
        }

        return self::LOADER_NOT_FOUND;
    } 
}
