<?php

namespace App\Xapis\Stock\BattInsulationMaterial\Kernel;

class BattMaterialRequirements
{
    public static $spaces_rvalues = [
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
            'R-11',
            'R-13',
            'R-19',
            'R-30',
            'R-38',
            'R-60',
        ],
    ];

    public static $types = [
        'faced',
        'unfaced',
    ];

    public static $sizes = [
        'large',
        'small',
    ];

    public static function allSpacesRvalues()
    {
        return collect( self::$spaces_rvalues );
    }

    public static function existsSpace($space)
    {
        return self::allSpacesRvalues()->has($space);
    }   

    public static function getSpaces()
    {
        return self::allSpacesRvalues()->keys();
    }

    public static function getRvalues()
    {
        return self::allSpacesRvalues()->values();
    }

    public static function getRvaluesBySpace(string $space)
    {
        return collect( self::allSpacesRvalues()->get($space) ?? [] );
    }

    public static function allTypes()
    {
        return collect( self::$types );
    }

    public static function allSizes()
    {
        return collect( self::$sizes );
    }
}
