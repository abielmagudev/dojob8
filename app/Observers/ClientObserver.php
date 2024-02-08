<?php

namespace App\Observers;

use App\Models\Client;
use App\Models\History;
use App\Observers\Kernel\HasObserverConstructor;
use App\Observers\Kernel\HookUserSetters;

class ClientObserver
{
    public function created(Client $client)
    {
        History::create([
            'description' => sprintf("<em>{$client->full_name}</em> client was created."),
            'link' => route('clients.show', $client),
            'model_type' => get_class($client),
            'model_id' => $client->id,
            'user_id' => mt_rand(1,10),
        ]);
    }

    public function updated(Client $client)
    {
        if(! $client->trashed() ) 
        {
            History::create([
                'description' => sprintf("<em>{$client->full_name}</em> client was updated."),
                'link' => route('clients.show', $client),
                'model_type' => get_class($client),
                'model_id' => $client->id,
                'user_id' => mt_rand(1,10),
            ]);
        }

    }

    public function deleted(Client $client)
    {
        History::create([
            'description' => sprintf("<em>{$client->full_name}</em> client was deleted."),
            'model_type' => get_class($client),
            'model_id' => $client->id,
            'user_id' => mt_rand(1,10),
        ]);
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
