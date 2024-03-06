<?php 

namespace App\Models\Media\Kernel;

class FileRestriction
{
    protected static $mimes = [
        'jpeg',
        'jpg',
        'png',
        'pdf',
        'xls',
    ];

    protected static $maxsize = 5120;


    // Statics

    public static function mimes()
    {
        return collect( self::$mimes );
    }

    public static function maxsize()
    {
        return self::$maxsize;
    }
}
