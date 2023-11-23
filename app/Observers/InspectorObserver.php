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
        $fake_user_id = mt_rand(1, 10);

        $inspector->updated_by = $fake_user_id;
    }


    public function updated(Inspector $inspector)
    {
        //
    }

    public function deleted(Inspector $inspector)
    {
        $fake_user_id = mt_rand(1, 10);

        $inspector->updated_by = $fake_user_id;
        $inspector->save();
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
