<?php

namespace App\Observers;

use App\Models\Contractor;
use App\Observers\Kernel\HasObserverConstructor;
use App\Observers\Kernel\HookUserSetters;

class ContractorObserver
{
    use HasObserverConstructor;
    use HookUserSetters;

    public function creating(Contractor $contractor)
    {
        $this->creatingBy($contractor, mt_rand(1,10));
        $this->updatingBy($contractor, mt_rand(1,10));
    }

    public function created(Contractor $contractor)
    {

    }

    public function updating(Contractor $contractor)
    {
        $this->updatingBy($contractor, mt_rand(1,10));
    }

    public function updated(Contractor $contractor)
    {

    }

    public function deleting(Contractor $contractor)
    {
        $this->deletingBy($contractor, mt_rand(1,10));
    }

    public function deleted(Contractor $contractor)
    {

    }

    public function restored(Contractor $contractor)
    {
        //
    }

    public function forceDeleted(Contractor $contractor)
    {
        //
    }
}
