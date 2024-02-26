<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if(! $user->can('see-payments') ) {
            abort(404);
        }

        return true;
    }

    public function update(User $user, WorkOrder $workOrder)
    {
        return $user->can('edit-members');
    }
}
