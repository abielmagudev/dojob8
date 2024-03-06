<?php

namespace App\Models\Media\Kernel;

use Illuminate\Database\Eloquent\Model;

class MediaModelDirectory
{
    protected static $roots = [
        \App\Models\Assessment::class => 'assessments',
        \App\Models\Inspection::class => 'inspections',
        \App\Models\Member::class => 'members',
        \App\Models\Settings::class => 'application',
        \App\Models\User::class => 'users',
        \App\Models\WorkOrder::class => 'work-orders',
    ];

    public static function roots()
    {
        return collect( self::$roots );
    }

    public static function root(Model $model)
    {
        return self::roots()->get( get_class($model) );
    }

    public static function get(Model $model)
    {
        return implode(DIRECTORY_SEPARATOR, [
            self::root($model), 
            $model->id
        ]);
    }
}
