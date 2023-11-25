<?php

namespace App\Observers;

use App\Models\Inspector;
use App\Observers\Kernel\HasObserverConstructor;
use App\Observers\Kernel\HookUserSetters;

class InspectorObserver
{
    use HasObserverConstructor;
    use HookUserSetters;

    public function creating(Inspector $inspector)
    {
        $this->creatingBy($inspector, mt_rand(1, 10));
        $this->updatingBy($inspector, mt_rand(1, 10));
    }

    public function created(Inspector $inspector)
    {
        //
    }

    public function updating(Inspector $inspector)
    {
        $this->updatingBy($inspector, mt_rand(1, 10));
    }


    public function updated(Inspector $inspector)
    {
        //
    }

    public function deleting(Inspector $inspector)
    {
        $this->deletingBy($inspector, mt_rand(1, 10));
    }

    public function deleted(Inspector $inspector)
    {

    }

    public function restored(Inspector $inspector)
    {
        //
    }

    public function forceDeleted(Inspector $inspector)
    {
        //
    }
}
