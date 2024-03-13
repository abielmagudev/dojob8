<?php

namespace App\Observers;

use App\Models\User;
use App\Models\History;
use Jenssegers\Agent\Facades\Agent;

class UserObserver
{
    public function created(User $user)
    {
        User::withoutEvents(function () use ($user) {
            $user->created_id = auth()->id();
            $user->updated_id = auth()->id();
            $user->save();
        });

        $user->history()->create([
            'description' => "User <b>{$user->name}</b> was created.",
            'link' => route('users.show', $user),
            'user_id' => auth()->id(),
        ]);
    }

    public function updated(User $user)
    {
        User::withoutEvents(function () use ($user) {
            $user->updated_id = auth()->id();
            $user->save();
        });

        $user->history()->create([
            'description' => "User <b>{$user->name}</b> was updated.",
            'link' => route('users.show', $user),
            'user_id' => auth()->id(),
        ]);
    }

    public function deleting(User $user)
    {
        User::withoutEvents(function() use ($user) {
            $user->deleted_id = auth()->id();
            $user->save();
        });      
    }

    public function deleted(User $user)
    {
        $user->history()->create([
            'description' => "User <b>{$user->name}</b> was deleted.",
            'link' => route('users.show', auth()->id()),
            'user_id' => auth()->id(),
        ]);
    }
}
