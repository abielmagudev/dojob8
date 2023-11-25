<?php

namespace App\Observers;

use App\Models\Job;
use App\Observers\Kernel\HasObserverConstructor;
use App\Observers\Kernel\HookUserSetters;

class JobObserver
{
    use HasObserverConstructor;
    use HookUserSetters;

    public function creating(Job $job)
    {
        $this->creatingBy($job, mt_rand(1,10));
        $this->updatingBy($job, mt_rand(1,10));
    }

    public function created(Job $job)
    {
        //
    }

    public function updating(Job $job)
    {
        $this->updatingBy($job, mt_rand(1,10));
    }

    public function updated(Job $job)
    {
        //
    }

    public function deleting(Job $job)
    {
        $this->deletingBy($job, mt_rand(1,10));
    }

    public function deleted(Job $job)
    {
        //
    }

    public function restored(Job $job)
    {
        //
    }

    public function forceDeleted(Job $job)
    {
        //
    }
}
