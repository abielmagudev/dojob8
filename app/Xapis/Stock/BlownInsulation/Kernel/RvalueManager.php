<?php

namespace App\Xapis\Stock\BlownInsulation\Kernel;

class RvalueManager
{
    protected static $rvalues = [
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
