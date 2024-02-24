<?php

namespace App\Http\Responses\Fortify;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;use Laravel\Fortify\Contracts\LoginResponse as FortifyLoginResponse;

class LoginResponse implements FortifyLoginResponse
{
    public function toResponse($request)
    {
        $user = $request->user();

        $timestamps = $user->timestamps;

        $user->timestamps = false;

        $user->fill([
            'last_session_at' => now(),
            'last_session_device' => (new Agent)->device(), // https://github.com/jenssegers/agent
            'last_session_ip' => $request->ip(),
        ])->save();

        $user->timestaps = $timestamps;

        return redirect()->route('dashboard.index');
    }
}
