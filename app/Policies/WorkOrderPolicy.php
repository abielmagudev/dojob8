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

    public function view(User $user, WorkOrder $work_order)
    {
        if(! $user->can('see-work-orders') ) {
            abort(404);
        }
        
        if( $user->hasRole('worker') &&! $work_order->members->contains( auth()->user()->profile_id ) ) {
            abort(404);
        }

        return true;
    }

    public function create(User $user)
    {
        return $user->can('create-work-orders');
    }

    public function update(User $user, WorkOrder $work_order)
    {
        if(! $user->can('edit-work-orders') ) {
            abort(404);
        }

        if( $user->hasRole('worker') &&! $work_order->members->contains( auth()->user()->profile_id ) ) {
            abort(404);
        }

        return true;
    }

    public function delete(User $user, WorkOrder $work_order)
    {
        return $user->hasRole('SuperAdmin');
    }

    public function restore(User $user, WorkOrder $work_order)
    {
        return $user->hasRole('SuperAdmin');
    }

    public function forceDelete(User $user, WorkOrder $work_order)
    {
        return $user->hasRole('SuperAdmin');
    }
}
