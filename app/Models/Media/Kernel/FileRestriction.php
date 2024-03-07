<?php 

namespace App\Models\Media\Kernel;

class FileRestriction
{
    protected static $accepts = [
        '.csv',
        '.jpeg',
        '.jpg',
        'application/pdf',
        // 'application/vnd.ms-excel',
        // 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'image/gif',
        'image/jpeg',
        'image/jpg',
        'image/png',
        'text/csv',
        'text/plain',
    ];

    protected static $mimes = [
        'jpeg',
        'jpg',
        'png',
        'pdf',
        'xls',
    ];

    protected static $maxsize = 5120;


    // Statics

    public static function accepts()
    {
        return collect( self::$accepts );
    }

    public static function mimes()
    {
        return collect( self::$mimes );
    }

    public static function maxsize()
    {
        return self::$maxsize;
    }
}
