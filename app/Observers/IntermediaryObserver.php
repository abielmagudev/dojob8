<?php

namespace App\Observers;

use App\Models\Intermediary;
use App\Observers\Kernel\HasObserverConstructor;
use App\Observers\Kernel\HookUserSetters;

class IntermediaryObserver
{
    use HasObserverConstructor;
    use HookUserSetters;

    public function creating(Intermediary $intermediary)
    {
        $this->creatingBy($intermediary, mt_rand(1,10));
        $this->updatingBy($intermediary, mt_rand(1,10));
    }

    public function created(Intermediary $intermediary)
    {

    }

    public function updating(Intermediary $intermediary)
    {
        $this->updatingBy($intermediary, mt_rand(1,10));
    }

    public function updated(Intermediary $intermediary)
    {

    }

    public function deleting(Intermediary $intermediary)
    {
        $this->deletingBy($intermediary, mt_rand(1,10));
    }

    public function deleted(Intermediary $intermediary)
    {

    }

    public function restored(Intermediary $intermediary)
    {
        //
    }

    public function forceDeleted(Intermediary $intermediary)
    {
        //
    }
}
