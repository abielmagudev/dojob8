<?php

namespace App\Policies;

use App\Models\Extension;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExtensionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if(! $user->can('see-extensions') ) {
            abort(404);
        }

        return true;
    }

    public function view(User $user)
    {
        if(! $user->can('see-extensions') ) {
            abort(404);
        }

        return true;
    }
}
