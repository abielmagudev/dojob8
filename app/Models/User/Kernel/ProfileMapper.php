<?php

namespace App\Models\User\Kernel;

use App\Models\Agency;
use App\Models\Contractor;
use App\Models\Member;
use Illuminate\Http\Request;

class ProfileMapper
{
    protected static $cache;

    protected static $profiles = [
        'agency' => Agency::class, 
        'contractor' => Contractor::class,
        'member' => Member::class,
    ];

    public static function collection()
    {
        if( is_null( self::$cache ) ) {
            self::$cache = collect( self::$profiles );
        }
        
        return self::$cache;
    }

    public static function shorts()
    {
        return self::collection()->keys();
    }

    public static function types()
    {
        return self::collection()->values();
    }

    public static function shortExists($short)
    {
        return self::collection()->has($short);
    }

    public static function containsType($type)
    {
        return self::collection()->contains($type);
    }

    public static function getType($short)
    {
        return self::collection()->get($short);
    }

    public static function getShort($type)
    {
        return self::collection()->search($type);
    }
}
