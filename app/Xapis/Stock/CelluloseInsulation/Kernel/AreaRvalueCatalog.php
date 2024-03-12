<?php

namespace App\Xapis\Stock\CelluloseInsulation\Kernel;

class AreaRvalueCatalog
{
    protected static $areas_rvalues = [
        'wall' => [
            'R-13 (2x4)' => 72.5,
            'R-15 (2x6)' => 61.5
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
