<?php

namespace App\Models\User\Kernel;

use App\Models\Agency;
use App\Models\Contractor;
use App\Models\Member;

class ProfileContainer
{
    protected static $cache;

    protected static $profiles = [
        'agency' => Agency::class, 
        'contractor' => Contractor::class,
        'member' => Member::class,
    ];

    public static function all()
    {
        if( is_null( self::$cache ) ) {
            self::$cache = collect( self::$profiles );
        }
        
        return self::$cache;
    }

    public static function shorts()
    {
        return self::all()->keys();
    }

    public static function types()
    {
        return self::all()->values();
    }

    public static function shortExists($short)
    {
        return self::all()->has($short);
    }

    public static function containsType($type)
    {
        return self::all()->contains($type);
    }

    public static function getShort($type)
    {
        return self::all()->search($type);
    }

    public static function getType($short)
    {
        return self::all()->get($short);
    }
}
