<?php

namespace App\Http\Controllers\WorkOrderController\Index;

use Illuminate\Http\Request;

class AuthDataLoader
{
    const UNKNOWN_LOADER = null;

    public static function get(Request $request)
    {
        if(! $loader_classname = DataLoadersContainer::get( auth()->user()->primary_role_name ) ) {
            return self::UNKNOWN_LOADER;
        }

        return app($loader_classname, [$request]);
    }
}
