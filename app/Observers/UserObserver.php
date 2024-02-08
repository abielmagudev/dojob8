<?php

namespace App\Observers;

use App\Models\User;
use App\Models\History;
use App\Observers\Kernel\HasObserverConstructor;
use Jenssegers\Agent\Facades\Agent;

class UserObserver
{
    use HasObserverConstructor;

    public function created(User $user)
    {
        User::withoutEvents(function () use ($user) {
            $user->updateCreatorUpdater();
        });

        History::create([
            'description' => sprintf("The <em>{$user->name}</em> user was created."),
            'link' => route('users.show', $user),
            'model_type' => User::class,
            'model_id' => $user->id,
            'user_id' => mt_rand(1,10),
        ]);
    }

    public function updated(User $user)
    {
        User::withoutEvents(function () use ($user) {
            $user->updateUpdater();
        });

        History::create([
            'description' => sprintf("The <em>{$user->name}</em> user was updated."),
            'link' => route('users.show', $user),
            'model_type' => User::class,
            'model_id' => $user->id,
            'user_id' => mt_rand(1,10),
        ]);
    }

    public function deleting(User $user)
    {
        User::withoutEvents(function() use ($user) {
            $user->updateDeleter();
        });      
    }

    public function deleted(User $user)
    {
        History::create([
            'description' => sprintf("The <em>{$user->name}</em> user was deleted."),
            'model_type' => User::class,
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
