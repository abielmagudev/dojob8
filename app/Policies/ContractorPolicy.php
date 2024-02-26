<?php

namespace App\Policies;

use App\Models\Contractor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContractorPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if(! $user->can('see-contractors') ) {
            abort(404);
        }

        return true;
    }

    public function view(User $user)
    {
        if(! $user->can('see-contractors') ) {
            abort(404);
        }

        return true;
    }

    public function create(User $user)
    {
        return $user->can('create-contractors');
    }

    public function update(User $user)
    {
        return $user->can('edit-contractors');
    }

    public function delete(User $user, Contractor $contractor)
    {
        return $user->hasRole('SuperAdmin');
    }

    public function restore(User $user, Contractor $contractor)
    {
        return $user->hasRole('SuperAdmin');
    }

    public function forceDelete(User $user, Contractor $contractor)
    {
        return $user->hasRole('SuperAdmin');
    }
}
