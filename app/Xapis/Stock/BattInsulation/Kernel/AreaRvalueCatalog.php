<?php

namespace App\Xapis\Stock\BattInsulation\Kernel;

class AreaRvalueCatalog
{
    protected static $areas_rvalues = [
        'attic' => [
            'R-19',
            'R-30',
            'R-38',
        ],

        'wall' => [
            'R-13',
            'R-15',
            'R-19',
        ],

        'underbelly' => [
            'R-19',
        ],
    ];

    public static function all()
    {
        return collect( self::$areas_rvalues );
    }

    public static function areas()
    {
        return self::all()->keys();
    }

    public static function areaExists($value)
    {
        return self::areas()->contains($value);
    }

    public static function rvalueNamesByArea($area)
    {
        return collect( self::all()->get($area) );
    }
}
