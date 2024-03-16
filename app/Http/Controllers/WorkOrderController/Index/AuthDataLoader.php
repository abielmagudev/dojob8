<?php

namespace App\Http\Controllers\WorkOrderController\Index;

use App\Models\User;

class AuthDataLoader
{
    const UNKNOWN_LOADER = null;

    public static function find(User $user)
    {
        if(! $classname = IndexDataLoadersContainer::get($user->primary_role_name) ) {
            return self::UNKNOWN_LOADER;
        }

        return app($classname);
    }
}
