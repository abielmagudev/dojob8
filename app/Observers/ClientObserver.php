<?php

namespace App\Observers;

use App\Models\Client;
use App\Models\History;
use App\Observers\Kernel\HasObserverConstructor;

class ClientObserver
{
    use HasObserverConstructor;

    public function created(Client $client)
    {
        Client::withoutEvents(function() use ($client) {
            $client->updateCreatorUpdater();
        });

        History::create([
            'description' => sprintf("<em>{$client->full_name}</em> client was created."),
            'link' => route('clients.show', $client),
            'model_type' => Client::class,
            'model_id' => $client->id,
        ]);
    }

    public function updated(Client $client)
    {
        Client::withoutEvents(function() use ($client) {
            $client->updateUpdater();
        });

        History::create([
            'description' => sprintf("<em>{$client->full_name}</em> client was updated."),
            'link' => route('clients.show', $client),
            'model_type' => Client::class,
            'model_id' => $client->id,
        ]);
    }

    public function deleting(Client $client)
    {
        Client::withoutEvents(function() use ($client) {
            $client->updateDeleter();
        });
    }

    public function deleted(Client $client)
    {
        History::create([
            'description' => sprintf("<em>{$client->full_name}</em> client was deleted."),
            'model_type' => Client::class,
            'model_id' => $client->id,
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
