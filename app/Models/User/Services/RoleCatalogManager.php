<?php

namespace App\Models\User\Services;

use App\Models\Agency;
use App\Models\Contractor;
use App\Models\Member;
use Illuminate\Database\Eloquent\Model;

class RoleCatalogManager
{
    public static function all()
    {
        return RoleCatalogService::roles();
    }

    public static function agency()
    {
        return RoleCatalogService::partner()->filter(fn($role) => $role == 'agency');
    }

    public static function contractor()
    {
        return RoleCatalogService::partner()->filter(fn($role) => $role == 'contractor');
    }

    public static function member()
    {
        return RoleCatalogService::merge(['admin', 'management', 'field']);
    }

    public static function byProfile(Model $profile)
    {   
        if( is_a($profile, Agency::class) ) {
            return self::agency();
        }

        if( is_a($profile, Contractor::class) ) {
            return self::contractor();
        }

        if( is_a($profile, Member::class) ) {
            return self::member();
        }

        return collect([]);
    }
}
