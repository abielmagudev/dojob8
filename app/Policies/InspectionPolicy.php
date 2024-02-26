<?php

namespace App\Policies;

use App\Models\Inspection;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InspectionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if(! $user->can('see-inspections') ) {
            abort(404);
        }

        return true;
    }

    public function view(User $user, Inspection $inspection)
    {
        if(! $user->can('see-inspections') ) {
            abort(404);
        }

        return true;
    }

    public function create(User $user)
    {
        return $user->can('create-inspections');
    }

    public function update(User $user, Inspection $inspection)
    {
        return $user->can('edit-inspections');
    }

    public function delete(User $user, Inspection $inspection)
    {
        return $user->hasRole('SuperAdmin');
    }
}
