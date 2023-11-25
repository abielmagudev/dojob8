<?php

namespace App\Observers;

use App\Models\Inspection;
use App\Observers\Kernel\HasObserverConstructor;
use App\Observers\Kernel\HookUserSetters;

class InspectionObserver
{
    use HasObserverConstructor;
    use HookUserSetters;

    public function creating(Inspection $inspection)
    {
        $this->creatingBy($inspection, mt_rand(1, 10));
        $this->updatingBy($inspection, mt_rand(1, 10));
    }

    public function created(Inspection $inspection)
    {
        //
    }

    public function updating(Inspection $inspection)
    {
        $this->updatingBy($inspection, mt_rand(1, 10));
    }

    public function updated(Inspection $inspection)
    {
        //
    }

    public function deleted(Inspection $inspection)
    {
        // 
    }

    public function restored(Inspection $inspection)
    {
        //
    }

    public function forceDeleted(Inspection $inspection)
    {
        //
    }
}
