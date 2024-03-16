<?php

namespace App\Models\WorkOrder\Kernel;

class WorkOrderTypeCatalog
{
    const DEFAULT_TYPE = 'standard';

    public static $types = [
        'standard',
        'rework',
        'warranty',
    ];

    public function __call($name, $arguments)
    {
        if(! method_exists(self::class, $name) ) {
            return call_user_func([self::class, $name]);
        }

        return;
    }

    public static function all()
    {
        return collect( self::$types );
    }

    public static function default()
    {
        return self::DEFAULT_TYPE;
    }

    public static function standard()
    {
        return self::all()->filter(fn($type) => $type == 'standard');
    }

    public static function rectification()
    {
        return self::all()->reject(fn($type) => $type == 'standard');
    }
}
