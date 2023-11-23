<?php

namespace App\Observers;

use App\Models\Client;

class ClientObserver
{
    public function creating(Client $client)
    {
        $fake_user_id = mt_rand(1, 10);

        $client->fill([
            'created_by' => $fake_user_id,
            'updated_by' => $fake_user_id,
        ]);
    }

    public function created(Client $client)
    {

    }

    public function updating(Client $client)
    {
        $fake_user_id = mt_rand(1, 10);

        $client->updated_by = $fake_user_id;
    }

    public function updated(Client $client)
    {
        
    }

    /**
     * Handle the Client "deleted" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    public function deleted(Client $client)
    {
        //
    }

    /**
     * Handle the Client "restored" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    public function restored(Client $client)
    {
        //
    }

    /**
     * Handle the Client "force deleted" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    public function forceDeleted(Client $client)
    {
        //
    }
}
