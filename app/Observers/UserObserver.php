<?php

namespace App\Observers;

use App\Models\User;
use App\Models\History;
use App\Observers\Kernel\HasObserverConstructor;
use App\Observers\Kernel\HookUserSetters;
use Jenssegers\Agent\Facades\Agent;

class UserObserver
{
    use HasObserverConstructor;
    use HookUserSetters;

    public function creating(User $user)
    {
        $this->creatingBy($user, mt_rand(1,10));
        $this->updatingBy($user, mt_rand(1,10));
    }

    public function created(User $user)
    {
        History::create([
            'description' => sprintf("The <em>{$user->name}</em> user was created."),
            'link' => route('users.show', $user),
            'model_type' => get_class($user),
            'model_id' => $user->id,
            'user_id' => mt_rand(1,10),
        ]);
    }

    public function updating(User $user)
    {
        $this->updatingBy($user, mt_rand(1,10));
    }

    public function updated(User $user)
    {
        if(! $this->request->isMethod('delete') )
        {
            History::create([
                'description' => sprintf("The <em>{$user->name}</em> user was updated."),
                'link' => route('users.show', $user),
                'model_type' => get_class($user),
                'model_id' => $user->id,
                'user_id' => mt_rand(1,10),
            ]);
        }
    }

    public function deleting(User $user)
    {
        $this->deletingBy($user, mt_rand(1,10));
    }

    public function deleted(User $user)
    {
        History::create([
            'description' => sprintf("The <em>{$user->name}</em> user was deleted."),
            'model_type' => get_class($user),
            'model_id' => $user->id,
            'user_id' => mt_rand(1,10),
        ]);
    }

    public function restored(User $user)
    {
        //
    }

    public function forceDeleted(User $user)
    {
        //
    }
}
