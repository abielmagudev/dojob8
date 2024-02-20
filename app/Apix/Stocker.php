<?php

namespace App\Apix;

use App\Apix\Kernel\SetupInterface;

class Stocker
{
    const STOCK_PATH = __DIR__ . DIRECTORY_SEPARATOR . 'Stock';

    public static function scanned()
    {
        return array_diff(
            scandir(self::STOCK_PATH), 
            ['.', '..']
        );
    }

    public static function all()
    {       
        $stock = [];

        foreach(self::scanned() as $apix)
        {
            $setup_path = self::path([$apix, 'Setup.php']);

            if( is_file($setup_path) && $setup_included = include($setup_path) )
            {
                if( in_array(SetupInterface::class, class_implements($setup_included)) )
                {
                    $stock[$apix] = $setup_path;
                }
            }

        }

        return $stock;
    }

    public static function onlyApixClassnames()
    {
        return array_keys( self::all() );
    }

    public static function onlyApixSetupRoutes()
    {
        return array_values( self::all() );
    }

    public static function path($nodes)
    {
        if( is_string($nodes) ) $nodes = [$nodes];

        return implode(DIRECTORY_SEPARATOR, [self::STOCK_PATH, ...$nodes]);
    }
}
