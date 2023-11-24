<?php

namespace App\Observers;

use App\Models\Client;
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

    }

    public function updating(Client $client)
    {
        $this->updatingBy($client, mt_rand(1, 10));
    }

    public function updated(Client $client)
    {
        //
    }

    public function deleting(Client $client)
    {
        $this->deletingBy($client, mt_rand(1, 10));
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
