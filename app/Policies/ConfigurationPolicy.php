<?php

namespace App\Policies;

use App\Models\Configuration;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConfigurationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if(! $user->can('see-configuration') ) {
            abort(404);
        }

        return true;
    }

    public function view(User $user, Configuration $configuration)
    {
        if(! $user->can('see-configuration') ) {
            abort(404);
        }

        return true;
    }

    public function update(User $user, Configuration $configuration)
    {
        return $user->can('edit-configuration');
    }

    public function delete(User $user, Configuration $configuration)
    {
        return $user->hasRole('SuperAdmin');
    }

    public function restore(User $user, Configuration $configuration)
    {
        return $user->hasRole('SuperAdmin');
    }

    public function forceDelete(User $user, Configuration $configuration)
    {
        return $user->hasRole('SuperAdmin');
    }
}
