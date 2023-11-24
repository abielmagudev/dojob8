<?php

namespace App\Observers;

use App\Models\Intermediary;
use App\Observers\Kernel\HasHookModifiers;
use App\Observers\Kernel\HasObserverConstructor;

class IntermediaryObserver
{
    use HasHookModifiers;
    use HasObserverConstructor;

    public function creating(Intermediary $intermediary)
    {
        $this->storingBy($intermediary);
    }

    public function created(Intermediary $intermediary)
    {
        //
    }

    public function updating(Intermediary $intermediary)
    {
        $this->updatingBy($intermediary);
    }

    public function updated(Intermediary $intermediary)
    {
        //
    }

    public function deleting(Intermediary $intermediary)
    {
        $this->deletingBy($intermediary);
    }

    public function deleted(Intermediary $intermediary)
    {
        //
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
