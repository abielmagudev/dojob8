<?php

namespace App\Models\Product\Kernel;

class MeasurementUnitsCatalog
{
    public static $cache;

    public static $measurement_units = [
        'ft' => 'feet',
        'sq. ft' => 'square feet',
        'in' => 'inch',
        'cm' => 'centimeter',
        'm' => 'meter',
        
        'lb' => 'pound',
        'g' => 'gram',
        'kg' => 'kilogram',

        'ea' => 'each',
        'itm' => 'item',
        'pz' => 'piece',
    ];

    public static function all()
    {
        if( is_null(self::$cache) ) {
            self::$cache = collect( self::$measurement_units );
        }

        return self::$cache;
    }

    public static function abbreviations()
    {
        return self::all()->keys();
    }

    public static function names()
    {
        return self::all()->values();
    }

    public static function abbreviation(string $name)
    {
        return self::all()->search($name);
    }

    public static function name(string $abbr)
    {
        return self::all()->get($abbr);
    }
}
