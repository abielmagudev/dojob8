<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if(! $user->can('see-comments') ) {
            abort(404);
        };
        
        return true;
    }

    public function create(User $user)
    {
        return $user->can('create-comments');
    }

    public function update(User $user)
    {
        return $user->can('edit-comments');
    }

    public function delete(User $user)
    {
        return $user->can('delete-comments');
    }
}
