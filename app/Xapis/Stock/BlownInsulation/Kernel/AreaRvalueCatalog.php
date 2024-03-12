<?php

namespace App\Xapis\Stock\BlownInsulation\Kernel;

class AreaRvalueCatalog
{
    protected static $areas_rvalues = [
        'attic' => [
            'R-13' => 168.5,
            'R-19' => 109.5,
            'R-22' => 94.1,
            'R-26' => 79.6,
            'R-30' => 68.5,
            'R-38' => 51.8,
            'R-44' => 44.5,
            'R-49' => 39.5,
            'R-60' => 31.4,
        ],

        'wall' => [
            'R-15 (2x4)' => 75.4,
            'R-21 (2x6)' => 55.4,
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

    public static function rvaluesByArea(string $area)
    {
        return collect( self::all()->get($area) );
    }

    public static function rvalueNamesByArea(string $area)
    {
        return self::rvaluesByArea($area)->keys();
    }

    public static function rvalueScoresByArea(string $area)
    {
        return self::rvaluesByArea($area)->values();
    }

    public static function rvalueScoreByArea(string $area, string $rvalue_name)
    {
        return self::rvaluesByArea($area)->get($rvalue_name);
    }
}
