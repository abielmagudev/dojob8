<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if(! $user->can('see-clients') ) {
            abort(404);
        }

        return true;
    }

    public function view(User $user)
    {
        if(! $user->can('see-clients') ) {
            abort(404);
        }

        return true;
    }

    public function create(User $user)
    {
        return $user->can('create-clients');
    }

    public function update(User $user)
    {
        return $user->can('edit-clients');
    }

    public function delete(User $user, Client $client)
    {
        return $user->hasRole('SuperAdmin');
    }

    public function restore(User $user, Client $client)
    {
        return $user->hasRole('SuperAdmin');
    }

    public function forceDelete(User $user, Client $client)
    {
        return $user->hasRole('SuperAdmin');
    }
}
