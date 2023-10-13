<?php

namespace App\Apix;

use Illuminate\Database\Eloquent\Collection;

class Register
{
    public static function scan()
    {
        return array_filter(scandir(__DIR__), function ($node) {
            return is_file( app_path("Apix/{$node}/Install.php") );
        });
    }

    public static function paths()
    {
        return array_map(function ($node) {
            return app_path("Apix/{$node}/Install.php");
        }, self::scan());
    }

    public static function filter()
    {
        return array_filter(self::paths(), function ($path) {
            return is_a(include($path), Installer::class);
        });
    }

    public static function apiExtensions()
    {
        return array_map(function($installer) {
            return include($installer);
        }, self::filter());
    }
}
