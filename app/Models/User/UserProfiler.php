<?php

namespace App\Models\User;

use App\Models\Agency;
use App\Models\Contractor;
use App\Models\Member;
use Illuminate\Http\Request;

class UserProfiler
{
    public static $classnicknames_classnames = [
        'agency' => Agency::class,
        'contractor' => Contractor::class,
        'member' => Member::class,
    ];

    public static function all()
    {
        return collect( self::$classnicknames_classnames );
    }

    public static function classnicknames()
    {
        return self::all()->keys();
    }

    public static function classnames()
    {
        return self::all()->values();
    }

    public static function getClassnicknameByClassname(string $value)
    {
        $classnickname = self::all()->search(function($classname) use ($value) { 
            return $classname == $value; 
        });

        return $classnickname ?? null;
    }

    public static function getClassnameByClassnickname(string $key)
    {
        return self::all()[$key] ?? null;
    }

    public static function find($id, $classnickname_key)
    {
        return ( self::getClassnameByClassnickname($classnickname_key) )::find($id);
    }
}
