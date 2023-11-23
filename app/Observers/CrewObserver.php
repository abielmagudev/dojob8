<?php

namespace App\Observers;

use App\Models\Crew;

class CrewObserver
{
    public function creating(Crew $crew)
    {
        $fake_user_id = mt_rand(1, 10);

        $crew->fill([
            'created_by' => $fake_user_id,
            'updated_by' => $fake_user_id,
        ]);
    }

    /**
     * Handle the Crew "created" event.
     *
     * @param  \App\Models\Crew  $crew
     * @return void
     */
    public function created(Crew $crew)
    {
        //
    }

    public function updating(Crew $crew)
    {
        $fake_user_id = mt_rand(1, 10);

        $crew->updated_by = $fake_user_id;
    }

    /**
     * Handle the Crew "updated" event.
     *
     * @param  \App\Models\Crew  $crew
     * @return void
     */
    public function updated(Crew $crew)
    {
        //
    }

    /**
     * Handle the Crew "deleted" event.
     *
     * @param  \App\Models\Crew  $crew
     * @return void
     */
    public function deleted(Crew $crew)
    {
        //
    }

    /**
     * Handle the Crew "restored" event.
     *
     * @param  \App\Models\Crew  $crew
     * @return void
     */
    public function restored(Crew $crew)
    {
        //
    }

    /**
     * Handle the Crew "force deleted" event.
     *
     * @param  \App\Models\Crew  $crew
     * @return void
     */
    public function forceDeleted(Crew $crew)
    {
        //
    }
}
