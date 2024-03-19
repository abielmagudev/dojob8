<?php

namespace App\Models\Assessment\Kernel;

class StatusCatalog
{
    const INITIAL = 'new';

    protected static $statuses = [
        'new',
        'working',
        'done',
        'canceled',
        // 'denialed',
        'deferred',
    ];

    public static function all()
    {
        return collect( self::$statuses );
    }
}
