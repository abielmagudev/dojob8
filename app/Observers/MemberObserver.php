<?php

namespace App\Observers;

use App\Models\Member;

class MemberObserver
{
    public function creating(Member $member)
    {
        $fake_user_id = mt_rand(1, 10);

        $member->fill([
            'created_by' => $fake_user_id,
            'updated_by' => $fake_user_id,
        ]);
    }

    /**
     * Handle the Member "created" event.
     *
     * @param  \App\Models\Member  $member
     * @return void
     */
    public function created(Member $member)
    {
        //
    }

    public function updating(Member $member)
    {
        $fake_user_id = mt_rand(1, 10);

        $member->updated_by = $fake_user_id;
    }

    /**
     * Handle the Member "updated" event.
     *
     * @param  \App\Models\Member  $member
     * @return void
     */
    public function updated(Member $member)
    {
        //
    }

    /**
     * Handle the Member "deleted" event.
     *
     * @param  \App\Models\Member  $member
     * @return void
     */
    public function deleted(Member $member)
    {
        //
    }

    /**
     * Handle the Member "restored" event.
     *
     * @param  \App\Models\Member  $member
     * @return void
     */
    public function restored(Member $member)
    {
        //
    }

    /**
     * Handle the Member "force deleted" event.
     *
     * @param  \App\Models\Member  $member
     * @return void
     */
    public function forceDeleted(Member $member)
    {
        //
    }
}
