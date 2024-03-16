<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if(! $user->can('see-categories') ) {
            abort(404);
        }

        return true;
    }

    public function view(User $user, Category $category)
    {
        if(! $user->can('see-categories') ) {
            abort(404);
        }

        return true;
    }

    public function create(User $user)
    {
        return $user->can('create-categories');
    }

    public function update(User $user, Category $category)
    {
        return $user->can('edit-categories');
    }

    public function delete(User $user, Category $category)
    {
        return $user->can('delete-categories');
    }
}
