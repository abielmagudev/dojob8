<?php

namespace App\Policies;

use App\Models\Settings;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingsPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if(! $user->can('see-settings') ) {
            abort(404);
        }

        return true;
    }

    public function view(User $user, Settings $settings)
    {
        if(! $user->can('see-settings') ) {
            abort(404);
        }

        return true;
    }

    public function update(User $user, Settings $settings)
    {
        return $user->can('edit-settings');
    }

    public function delete(User $user, Settings $settings)
    {
        return $user->hasRole('SuperAdmin');
    }

    public function restore(User $user, Settings $settings)
    {
        return $user->hasRole('SuperAdmin');
    }

    public function forceDelete(User $user, Settings $settings)
    {
        return $user->hasRole('SuperAdmin');
    }
}
