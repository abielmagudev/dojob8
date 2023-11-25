<?php

namespace App\Observers;

use App\Models\Member;
use App\Observers\Kernel\HasObserverConstructor;
use App\Observers\Kernel\HookUserSetters;

class MemberObserver
{
    use HasObserverConstructor;
    use HookUserSetters;

    public function creating(Member $member)
    {
        $this->creatingBy($member, mt_rand(1,10));
        $this->updatingBy($member, mt_rand(1,10));
    }

    public function created(Member $member)
    {
        //
    }

    public function updating(Member $member)
    {
        $this->updatingBy($member, mt_rand(1,10));
    }

    public function updated(Member $member)
    {
        //
    }

    public function deleting(Member $member)
    {
        $this->deletingBy($member, mt_rand(1,10));
    }

    public function deleted(Member $member)
    {
        //
    }

    public function restored(Member $member)
    {
        //
    }

    public function forceDeleted(Member $member)
    {
        //
    }
}
