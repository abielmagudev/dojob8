<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;
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

    public function update(User $user, Payment $payment)
    {
        return $user->can('edit-payments');
    }
}
