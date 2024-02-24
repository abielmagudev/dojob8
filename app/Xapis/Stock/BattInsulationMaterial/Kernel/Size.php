<?php

namespace App\Xapis\Stock\BattInsulationMaterial\Kernel;

class Size
{
    protected static $sizes = [
        'large',
        'small',
    ];

    public static function all()
    {
        return collect( self::$sizes );
    }

    public static function exists($value)
    {
        return self::all()->contains($value);
    }
}
