<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemberPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if(! $user->can('see-members') ) {
            abort(404);
        }

        return true;
    }

    public function view(User $user, Member $member)
    {
        if(! $user->can('see-members') ) {
            abort(404);
        }

        return true;
    }

    public function create(User $user)
    {
        return $user->can('create-members');
    }

    public function update(User $user, Member $member)
    {
        return $user->can('edit-members');
    }

    public function delete(User $user, Member $member)
    {
        return $user->hasRole('SuperAdmin');
    }

    public function restore(User $user, Member $member)
    {
        return $user->hasRole('SuperAdmin');
    }

    public function forceDelete(User $user, Member $member)
    {
        return $user->hasRole('SuperAdmin');
    }
}
