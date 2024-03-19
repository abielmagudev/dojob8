<?php

namespace App\Models\WorkOrder\Kernel;

class WorkOrderStatusCatalog
{
    const INITIAL = 'new';

    public static $statuses = [
        'pause',
        'new',
        'working',
        'done',
        'completed',
        'canceled',
        // 'denialed',
        'deferred',
    ];

    public static function all()
    {
        return collect( self::$statuses );
    } 

    public static function incomplete()
    {
        return self::all()->reject(fn($status) => in_array($status, [
            'completed',
            'canceled',
            'denialed'
        ]));
    }

    public static function closed()
    {
        return self::all()->reject(fn($status) => in_array($status, [
            'pause', 
            'new', 
            'working', 
            'done'
        ]));
    }
}
