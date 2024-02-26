<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if(! $user->can('see-jobs') ) {
            abort(404);
        }

        return true;
    }

    public function view(User $user, Job $job)
    {
        if(! $user->can('see-jobs') ) {
            abort(404);
        }

        return true;
    }

    public function create(User $user)
    {
        return $user->can('create-jobs');
    }

    public function update(User $user, Job $job)
    {
        return $user->can('edit-jobs');
    }

    public function delete(User $user, Job $job)
    {
        return $user->hasRole('SuperAdmin');
    }

    public function restore(User $user, Job $job)
    {
        return $user->hasRole('SuperAdmin');
    }

    public function forceDelete(User $user, Job $job)
    {
        return $user->hasRole('SuperAdmin');
    }
}
