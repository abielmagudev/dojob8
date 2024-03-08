<?php

namespace App\Models\User\Services;

use App\Models\Agency;
use App\Models\Contractor;
use App\Models\Member;
use Illuminate\Database\Eloquent\Model;

class RoleCatalogManager
{
    public static function exceptRoles($except = [])
    {
        if(! is_array($except) ) {
            $except = [$except];
        }

        return RoleCatalogService::roles()->reject(function ($role) use ($except) {
            return in_array($role, $except);
        });
    }   

    public static function exceptSuperAdminRole()
    {
        return self::exceptRoles('SuperAdmin');
    }

    public static function byProfile(Model $profile)
    {   
        if( is_a($profile, Agency::class) ) {
            return RoleCatalogService::partner()->filter(fn($role) => $role == 'agency');
        }

        if( is_a($profile, Contractor::class) ) {
            return RoleCatalogService::partner()->filter(fn($role) => $role == 'contractor');
        }

        if( is_a($profile, Member::class) ) {
            return RoleCatalogService::merge(['admin','field'])->reject(fn($role) => $role == 'SuperAdmin');
        }

        return collect([]);
    }
}
