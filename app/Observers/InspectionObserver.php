<?php

namespace App\Observers;

use App\Models\Inspection;

class InspectionObserver
{
    public function creating(Inspection $inspection)
    {
        $fake_user_id = mt_rand(1, 10);

        $inspection->created_by = $fake_user_id;
        $inspection->updated_by = $fake_user_id;
    }

    public function created(Inspection $inspection)
    {
        //
    }

    public function updating(Inspection $inspection)
    {
        $inspection->updated_by = mt_rand(1, 10);
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
