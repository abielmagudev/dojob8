<?php

namespace App\Observers;

use App\Models\Crew;
use App\Observers\Kernel\HasObserverConstructor;
use App\Observers\Kernel\HookUserSetters;

class CrewObserver
{
    use HasObserverConstructor;
    use HookUserSetters;

    public function creating(Crew $crew)
    {
        $this->creatingBy($crew, mt_rand(1, 10));
        $this->updatingBy($crew, mt_rand(1, 10));
    }

    public function created(Crew $crew)
    {
        //
    }

    public function updating(Crew $crew)
    {
        $this->updatingBy($crew, mt_rand(1, 10));
    }

    public function updated(Crew $crew)
    {
        //
    }

    public function deleting(Crew $crew)
    {
        $this->deletingBy($crew, mt_rand(1, 10));
    }

    public function deleted(Crew $crew)
    {
        //
    }

    public function restored(Crew $crew)
    {
        //
    }

    public function forceDeleted(Crew $crew)
    {
        //
    }
}
