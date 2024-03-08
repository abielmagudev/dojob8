<?php

namespace App\Models\User\Services;

class MemberRoleCatalogService
{
    public static function all()
    {
        return RoleCatalogService::merge(['admin', 'field']);
    }

    public static function except($except_roles)
    {
        if(! is_array($except_roles) ) {
            $except_roles = [$except_roles];
        }

        return self::all()->reject(function($role) use ($except_roles) {
           return in_array($role, $except_roles);
        });
    }

    public static function exceptSuperAdmin()
    {
        return self::except('SuperAdmin');
    }
}
