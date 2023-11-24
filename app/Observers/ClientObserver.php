<?php

namespace App\Observers;

use App\Models\Client;

class ClientObserver
{
    public function creating(Client $client)
    {
        $fake_user_id = mt_rand(1, 10);

        $client->created_by = $fake_user_id;
        $client->updated_by = $fake_user_id;
    }

    public function created(Client $client)
    {

    }

    public function updating(Client $client)
    {
        $client->updated_by = mt_rand(1, 10);
    }

    public function updated(Client $client)
    {
        //
    }

    public function deleting(Client $client)
    {
        $client->timestamps = false;
        $client->deleted_by = mt_rand(1, 10);
        $client->save();
        $client->timtestamps = true;
    }

    public function deleted(Client $client)
    {
        //
    }

    public function restored(Client $client)
    {
        //
    }

    public function forceDeleted(Client $client)
    {
        //
    }
}
