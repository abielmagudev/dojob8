<?php

namespace App\Xapis\Stock\BattInsulation\Kernel;

class TypeCatalog
{
    protected static $types = [
        'faced',
        'unfaced',
    ];

    public static function all()
    {
        return collect( self::$types );
    }

    public static function exists($value)
    {
        return self::all()->contains($value);
    }
}