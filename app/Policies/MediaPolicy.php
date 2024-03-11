<?php

namespace App\Policies;

use App\Models\Media;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if(! $user->can('see-files') ) {
            abort(404);
        }

        return true;
    }

    public function view(User $user, Media $media)
    {
        if(! $user->can('see-files') ) {
            abort(404);
        }

        return true;
    }

    public function create(User $user)
    {
        return $user->can('create-files');
    }

    public function update(User $user, Media $media)
    {
        return $user->can('edit-files');
    }

    public function delete(User $user, Media $media)
    {
        return $user->hasRole('SuperAdmin');
    }
}
