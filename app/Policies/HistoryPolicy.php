<?php

namespace App\Policies;

use App\Models\History;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HistoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if(! $user->can('see-history') ) {
            abort(404);
        }

        return true;
    }

    public function delete(User $user, History $history)
    {
        return $user->hasRole('SuperAdmin');
    }
}
