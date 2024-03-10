<?php

namespace App\Models\WorkOrder\Kernel;

class WorkOrderTypeCatalog
{
    const DEFAULT = 'standard';
    
    public static $types = [
        'standard',
        'rework',
        'warranty',
    ];

    public static function all()
    {
        return collect( self::$types );
    }

    public static function rectification()
    {
        return self::all()->reject(fn($type) => $type == 'standard');
    }
}
