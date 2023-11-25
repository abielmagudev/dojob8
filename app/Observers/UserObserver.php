<?php

namespace App\Observers;

use App\Models\User;
use App\Observers\Kernel\HasObserverConstructor;
use App\Observers\Kernel\HookUserSetters;

class UserObserver
{
    use HasObserverConstructor;
    use HookUserSetters;

    public function creating(User $user)
    {
        $this->creatingBy($user, mt_rand(1,10));
        $this->updatingBy($user, mt_rand(1,10));
    }

    public function created(User $user)
    {
        //
    }

    public function updating(User $user)
    {
        $this->updatingBy($user, mt_rand(1,10));
    }

    public function updated(User $user)
    {
        //
    }

    public function deleting(User $user)
    {
        $this->deletingBy($user, mt_rand(1,10));
    }

    public function deleted(User $user)
    {
        //
    }

    public function restored(User $user)
    {
        //
    }

    public function forceDeleted(User $user)
    {
        //
    }
}
