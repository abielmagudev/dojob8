<?php

namespace App\Http\Controllers\WorkOrderController\Index;

use App\Http\Controllers\WorkOrderController\Index\Data\ManagementLoader;
use App\Http\Controllers\WorkOrderController\Index\Data\AssessorLoader;
use App\Http\Controllers\WorkOrderController\Index\Data\ContractorLoader;
use App\Http\Controllers\WorkOrderController\Index\Data\CrewMemberLoader;

class DataLoadersContainer
{
    const LOADER_NOT_FOUND = false;

    public static $management_loaders = [
        'SuperAdmin',
        'administrator',
        'manager',
        'coordinator',
    ];

    public static function get(string $loader)
    {
        if( in_array($loader, self::$management_loaders) ) {
            return ManagementLoader::class;
        }

        if( $loader == 'assessor' ) {
            return AssessorLoader::class;
        }

        if( $loader == 'contractor' ) {
            return ContractorLoader::class;
        }

        if( $loader == 'crew member' ) {
            return CrewMemberLoader::class;
        }

        return self::LOADER_NOT_FOUND;
    } 
}
