<?php

namespace App\Models\Inspection\Kernel;

class InspectionStatusCatalog
{
    const INITIAL = 'awaiting';

    public static $statuses = [
        'awaiting',
        'failed',
        'success',
    ];

    public static function all()
    {
        return collect( self::$statuses );
    }
}
