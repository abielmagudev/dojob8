<?php

namespace App\Policies;

use App\Models\File;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if(! $user->can('see-files') ) {
            abort(404);
        }

        return true;
    }

    public function view(User $user, File $file)
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

    public function update(User $user, File $file)
    {
        return $user->can('edit-files');
    }

    public function delete(User $user, File $file)
    {
        return $user->hasRole('SuperAdmin');
    }
}
