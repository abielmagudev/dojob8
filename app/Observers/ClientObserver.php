<?php

namespace App\Observers;

use App\Models\Client;

class ClientObserver
{
    public function created(Client $client)
    {
        Client::withoutEvents(function() use ($client) {
            $client->created_id = auth()->id();
            $client->updated_id = auth()->id();
            $client->save();
        });

        $client->history()->create([
            'description' => sprintf("Client <b>{$client->full_name}</b> was created."),
            'link' => route('clients.show', $client),
            'user_id' => auth()->id(),
        ]);
    }

    public function updated(Client $client)
    {
        Client::withoutEvents(function() use ($client) {
            $client->updated_id = auth()->id();
            $client->save();
        });

        $client->history()->create([
            'description' => sprintf("Client <b>{$client->full_name}</b> was updated."),
            'link' => route('clients.show', $client),
            'user_id' => auth()->id(),
        ]);
    }

    public function deleting(Client $client)
    {
        Client::withoutEvents(function() use ($client) {
            $client->deleted_id = auth()->id();
            $client->save();
        });
    }

    public function deleted(Client $client)
    {
        $client->history()->create([
            'description' => sprintf("Client <b>{$client->full_name}</b> was deleted."),
            'link' => route('users.show', auth()->id()),
            'user_id' => auth()->id(),
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
