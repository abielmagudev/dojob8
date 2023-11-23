<?php

namespace App\Observers;

use App\Models\Inspector;

class InspectorObserver
{
    public function creating(Inspector $inspector)
    {
        $fake_user_id = mt_rand(1, 10);

        $inspector->created_by = $fake_user_id;
        $inspector->updated_by = $fake_user_id;
    }

    public function created(Inspector $inspector)
    {
        //
    }

    public function updating(Inspector $inspector)
    {
        $inspector->updated_by = mt_rand(1, 10);
    }


    public function updated(Inspector $inspector)
    {
        //
    }

    public function deleting(Inspector $inspector)
    {
        $inspector->timestamps = false;
        $inspector->deleted_by = mt_rand(1, 10);
        $inspector->save();
        $inspector->timtestamps = true;
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
