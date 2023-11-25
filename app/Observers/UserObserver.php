<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserActiviy;
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
        UserActiviy::create([
            'description' => sprintf('The <a href="%s">%s</a> user was created', route('users.show', $user), $user->name),
            'device' => Agent::deviceType(),
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
            UserActiviy::create([
                'description' => sprintf('The <a href="%s">%s</a> user was updated', route('users.show', $user), $user->name),
                'device' => Agent::deviceType(),
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
        UserActiviy::create([
            'description' => sprintf('The %s user was deleted', $user->name),
            'device' => Agent::deviceType(),
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
