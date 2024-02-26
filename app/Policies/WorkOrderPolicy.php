<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkOrderPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if(! $user->can('see-work-orders') ) {
            abort(404);
        }

        return true;
    }

    public function view(User $user, WorkOrder $workOrder)
    {
        if(! $user->can('see-work-orders') ) {
            abort(404);
        }

        return true;
    }

    public function create(User $user)
    {
        return $user->can('create-work-orders');
    }

    public function update(User $user, WorkOrder $workOrder)
    {
        return $user->can('edit-work-orders');
    }

    public function delete(User $user, WorkOrder $workOrder)
    {
        return $user->hasRole('SuperAdmin');
    }

    public function restore(User $user, WorkOrder $workOrder)
    {
        return $user->hasRole('SuperAdmin');
    }

    public function forceDelete(User $user, WorkOrder $workOrder)
    {
        return $user->hasRole('SuperAdmin');
    }
}
