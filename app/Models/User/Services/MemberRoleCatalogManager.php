<?php

namespace App\Models\User\Services;

use App\Models\User;

class MemberRoleCatalogManager
{
    public static function restrictedByUserRole(User $user)
    {
        $first_role = $user->roles->first()->name;

        if( $first_role <> 'SuperAdmin' ) {
            return MemberRoleCatalogService::exceptSuperAdmin();
        }

        return MemberRoleCatalogService::all();
    }
}
