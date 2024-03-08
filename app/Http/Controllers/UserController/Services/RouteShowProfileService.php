<?php

namespace App\Http\Controllers\UserController\Services;

use Illuminate\Database\Eloquent\Model;

class RouteShowProfileService
{
    protected static $routes = [
        \App\Models\Agency::class => 'agencies.show',
        \App\Models\Contractor::class => 'contractors.show',
        \App\Models\Member::class => 'members.show',
    ];

    public static function collection()
    {
        return collect( self::$routes );
    }

    public static function get(Model $profile, $default = 'users.index')
    {
        if(! self::collection()->has( get_class($profile) ) ) {
            return route($default);
        }

        $route = self::collection()->get( get_class($profile) );

        return route($route, $profile);
    }
}
