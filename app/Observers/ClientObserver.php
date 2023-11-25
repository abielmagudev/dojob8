<?php

namespace App\Observers;

use App\Models\Client;
use App\Models\History;
use App\Observers\Kernel\HasObserverConstructor;
use App\Observers\Kernel\HookUserSetters;

class ClientObserver
{
    use HasObserverConstructor;
    use HookUserSetters;

    public function creating(Client $client)
    {
        $this->creatingBy($client, mt_rand(1, 10));
        $this->updatingBy($client, mt_rand(1, 10));
    }

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

    public function updating(Client $client)
    {
        $this->updatingBy($client, mt_rand(1, 10));
    }

    public function updated(Client $client)
    {
        if(! $this->request->isMethod('delete') )
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

    public function deleting(Client $client)
    {
        $this->deletingBy($client, mt_rand(1, 10));
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
