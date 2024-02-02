<?php

namespace App\Models\User;

use App\Models\Contractor;
use App\Models\Member;
use Illuminate\Http\Request;

class UserProfiler
{
    public static $profiles_classnames = [
        'contractor' => Contractor::class,
        'member' => Member::class,
    ];

    public static function all()
    {
        return collect( self::$profiles_classnames );
    }

    public static function profiles()
    {
        return self::all()->keys();
    }

    public static function classnames()
    {
        return self::all()->values();
    }

    public static function getProfileByClassname(string $value)
    {
        $profile = self::all()->search(function($classname) use ($value) { 
            return $classname == $value; 
        });

        return $profile ?? null;
    }

    public static function getClassnameByProfile(string $value)
    {
        return self::all()[$value] ?? null;
    }

    public static function find($profile, $id)
    {
        return ( self::getClassnameByProfile($profile) )::find($id);
    }
}