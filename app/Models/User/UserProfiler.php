<?php

namespace App\Models\User;

use App\Models\Intermediary;
use App\Models\Member;
use Illuminate\Http\Request;

class UserProfiler
{
    public static $aliases_profiles = [
        'intermediary' => Intermediary::class,
        'staff' => Member::class,
    ];

    public static function getAliasesProfiles()
    {
        return collect( self::$aliases_profiles );
    }

    public static function getAliases()
    {
        return self::getAliasesProfiles()->keys();
    }

    public static function getProfiles()
    {
        return self::getAliasesProfiles()->values();
    }

    public static function getAliasByProfile(string $profile_parameter)
    {
        foreach(self::getAliasesProfiles() as $alias => $profile)
        {
            if( $profile == $profile_parameter) {
                return $alias;
            }
        }

        return null;
    }

    public static function getProfileByAlias(string $alias_parameter)
    {
        return self::getAliasesProfiles()[$alias_parameter] ?? null;
    }

    public static function getAliasNameRequest(Request $request)
    {
        return self::getAliases()->filter(function ($alias) use ($request) {
            return $request->has($alias);
        })->first();
    }

    public static function getAliasValueRequest(Request $request)
    {
        return $request->get(
            self::getAliasNameRequest($request)
        );
    }

    public static function instanceProfileByRequest(Request $request)
    {
        if(! $alias = self::getAliasNameRequest($request) ) {
            return;
        }

        return ( self::getProfileByAlias($alias) )::find(
            self::getAliasValueRequest($request)
        );
    }
}