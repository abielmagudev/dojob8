<?php

namespace App\Policies;

use App\Models\Crew;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CrewPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if(! $user->can('see-crews') ) {
            abort(404);
        }

        return true;
    }

    public function view(User $user)
    {
        if(! $user->can('see-crews') ) {
            abort(404);
        }

        return true;
    }

    public function create(User $user)
    {
        return $user->can('create-crews');
    }

    public function update(User $user)
    {
        return $user->can('edit-crews');
    }

    public function delete(User $user, Crew $crew)
    {
        return $user->hasRole('SuperAdmin');
    }

    public function restore(User $user, Crew $crew)
    {
        return $user->hasRole('SuperAdmin');
    }

    public function forceDelete(User $user, Crew $crew)
    {
        return $user->hasRole('SuperAdmin');
    }
}
