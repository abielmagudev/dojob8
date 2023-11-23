<?php

namespace App\Observers;

use App\Models\Intermediary;

class IntermediaryObserver
{
    public function creating(Intermediary $intermediary)
    {
        $fake_user_id = mt_rand(1, 10);

        $intermediary->fill([
            'created_by' => $fake_user_id,
            'updated_by' => $fake_user_id,
        ]);
    }

    /**
     * Handle the Intermediary "created" event.
     *
     * @param  \App\Models\Intermediary  $intermediary
     * @return void
     */
    public function created(Intermediary $intermediary)
    {
        //
    }

    public function updating(Intermediary $intermediary)
    {
        $fake_user_id = mt_rand(1, 10);

        $intermediary->updated_by = $fake_user_id;
    }

    /**
     * Handle the Intermediary "updated" event.
     *
     * @param  \App\Models\Intermediary  $intermediary
     * @return void
     */
    public function updated(Intermediary $intermediary)
    {
        //
    }

    /**
     * Handle the Intermediary "deleted" event.
     *
     * @param  \App\Models\Intermediary  $intermediary
     * @return void
     */
    public function deleted(Intermediary $intermediary)
    {
        //
    }

    /**
     * Handle the Intermediary "restored" event.
     *
     * @param  \App\Models\Intermediary  $intermediary
     * @return void
     */
    public function restored(Intermediary $intermediary)
    {
        //
    }

    /**
     * Handle the Intermediary "force deleted" event.
     *
     * @param  \App\Models\Intermediary  $intermediary
     * @return void
     */
    public function forceDeleted(Intermediary $intermediary)
    {
        //
    }
}
