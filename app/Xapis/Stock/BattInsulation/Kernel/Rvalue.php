<?php

namespace App\Xapis\Stock\BattInsulation\Kernel;

class Rvalue
{
    protected static $rvalues_by_space = [
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

    public static function collection()
    {
        return collect( self::$rvalues_by_space );
    }

    public static function spaces()
    {
        return self::collection()->keys();
    }

    public static function spaceExists($value)
    {
        return self::spaces()->contains($value);
    }

    public static function allBySpace($space)
    {
        return self::spaceExists($space) ? collect( self::collection()->get($space) ) : [];
    }
}
