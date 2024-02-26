<?php

namespace App\Policies;

use App\Models\Agency;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgencyPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if(! $user->can('see-agencies') ) {
            abort(404);
        }

        return true;
    }

    public function view(User $user)
    {
        if(! $user->can('see-agencies') ) {
            abort(404);
        }

        return true;
    }

    public function create(User $user)
    {
        return $user->can('create-agencies');
    }

    public function update(User $user)
    {
        return $user->can('edit-agencies');
    }

    public function delete(User $user, Agency $agency)
    {
        return $user->hasRole('SuperAdmin');
    }

    public function restore(User $user, Agency $agency)
    {
        return $user->hasRole('SuperAdmin');
    }

    public function forceDelete(User $user, Agency $agency)
    {
        return $user->hasRole('SuperAdmin');
    }
}
