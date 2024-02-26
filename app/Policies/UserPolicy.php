<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if(! $user->can('see-users') ) {
            abort(404);
        }

        return true;
    }

    public function view(User $user, User $model)
    {
        if(! $user->can('see-users') ) {
            abort(404);
        }

        return true;
    }

    public function create(User $user)
    {
        return $user->can('create-users');
    }

    public function update(User $user, User $model)
    {
        return $user->can('edit-users');
    }

    public function delete(User $user, User $model)
    {
        return $user->hasRole('SuperAdmin');
    }

    public function restore(User $user, User $model)
    {
        return $user->hasRole('SuperAdmin');
    }

    public function forceDelete(User $user, User $model)
    {
        return $user->hasRole('SuperAdmin');
    }
}
