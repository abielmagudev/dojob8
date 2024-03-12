<?php

namespace App\Policies;

use App\Models\Assessment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssessmentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if(! $user->can('see-assessments') ) {
            abort(404);
        }

        return true;
    }

    public function view(User $user, Assessment $assessment)
    {
        if(! $user->can('see-assessments') ) {
            abort(404);
        }

        return true;
    }

    public function create(User $user)
    {
        return $user->can('create-assessments');
    }

    public function update(User $user, Assessment $assessment)
    {
        return $user->can('edit-assessments');
    }

    public function delete(User $user, Assessment $assessment)
    {
        return $user->can('delete-assessments');
    }
}
