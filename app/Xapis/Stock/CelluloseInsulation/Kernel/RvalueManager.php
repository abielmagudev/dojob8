<?php

namespace App\Xapis\Stock\CelluloseInsulation\Kernel;

class RvalueManager
{
    protected static $rvalues = [
        'wall' => [
            'R-13 (2x4)' => 72.5,
            'R-15 (2x6)' => 61.5
        ],
    ];

    public static function all()
    {
        return collect( self::$rvalues );
    }

    public static function spaces()
    {
        return self::all()->keys();
    }

    public static function rvaluesBySpace(string $space)
    {
        return collect( self::all()->get($space) );
    }

    public static function rvalueNamesBySpace(string $space)
    {
        return collect( self::rvaluesBySpace($space) )->keys();
    }

    public static function rvalueScoresBySpace(string $space)
    {
        return collect( self::rvaluesBySpace($space) )->values();
    }

    public static function rvalueScoreBySpace(string $space, string $rvalue_name)
    {
        return self::rvaluesBySpace($space)->get($rvalue_name);
    }
}
