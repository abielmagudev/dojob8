<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AbortUserHasSuperAdminRole
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->route('user');

        if( $user->id == auth()->id() || $user->hasRole('SuperAdmin') ) {
            abort(404);
        }

        return $next($request);
    }
}
