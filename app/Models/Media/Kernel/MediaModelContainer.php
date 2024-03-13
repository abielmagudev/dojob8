<?php

namespace App\Models\Media\Kernel;

class MediaModelContainer
{
    protected static $models = [
        'application' => \App\Models\Settings::class,
        'assessment' => \App\Models\Assessment::class,
        'inspection' => \App\Models\Inspection::class,
        'member' => \App\Models\Member::class,
        'user' => \App\Models\User::class,
        'work-order' => \App\Models\WorkOrder::class,
    ];

    public static function models()
    {
        return collect( self::$models );
    }

    public static function has(string $key)
    {
        return self::models()->has($key);
    }
    
    public static function search($value)
    {
        return self::models()->search($value);
    }

    public static function get(string $key)
    {
        return self::models()->get($key);
    }

    public static function find(string $key, $id)
    {
        $classname = self::get($key);
        
        return $classname::findOrFail($id);
    }
}
