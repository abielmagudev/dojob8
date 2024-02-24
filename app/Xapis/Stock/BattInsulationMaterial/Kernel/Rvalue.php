<?php

namespace App\Xapis\Stock\BattInsulationMaterial\Kernel;

class Rvalue
{
    protected static $spaces_rvalues = [
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
        return collect( self::$spaces_rvalues );
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
