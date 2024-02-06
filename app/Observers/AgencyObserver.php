<?php

namespace App\Observers;

use App\Models\Agency;
use App\Observers\Kernel\HasObserverConstructor;
use App\Observers\Kernel\HookUserSetters;

class AgencyObserver
{
    use HasObserverConstructor;
    use HookUserSetters;

    public function creating(Agency $agency)
    {
        $this->creatingBy($agency, mt_rand(1, 10));
        $this->updatingBy($agency, mt_rand(1, 10));
    }

    public function created(Agency $agency)
    {
        //
    }

    public function updating(Agency $agency)
    {
        $this->updatingBy($agency, mt_rand(1, 10));
    }


    public function updated(Agency $agency)
    {
        //
    }

    public function deleting(Agency $agency)
    {
        $this->deletingBy($agency, mt_rand(1, 10));
    }

    public function deleted(Agency $agency)
    {

    }

    public function restored(Agency $agency)
    {
        //
    }

    public function forceDeleted(Agency $agency)
    {
        //
    }
}
