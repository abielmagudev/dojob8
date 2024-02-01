<?php 

namespace App\Http\Controllers\CrewController;

class IndexTemplate
{
    public static $templates = [
        'grid',
        'list',
    ];

    public static function all()
    {
        return collect( self::$templates );
    }

    public static function default()
    {
        return self::all()->first();
    }

    public static function exists($template)
    {
        return self::all()->contains($template);
    }

    public static function get($template)
    {
        return self::exists($template) ? $template : self::default();
    }
}
