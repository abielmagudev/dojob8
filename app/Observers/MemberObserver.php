<?php

namespace App\Observers;

use App\Models\Member;

class MemberObserver
{
    public function created(Member $member)
    {
        Member::withoutEvents(function() use ($member) {
            $member->created_id = auth()->id();
            $member->updated_id = auth()->id();
            $member->save();
        });

        $member->history()->create([
            'description' => sprintf("Member <b>{$member->full_name}</b> was created."),
            'link' => route('members.show', $member),
            'user_id' => auth()->id(),
        ]);
    }

    public function updated(Member $member)
    {
        Member::withoutEvents(function() use ($member) {
            $member->updated_id = auth()->id();
            $member->save();
        });

        $member->history()->create([
            'description' => sprintf("Member <b>{$member->full_name}</b> was updated."),
            'link' => route('members.show', $member),
            'user_id' => auth()->id(),
        ]);
    }

    public function deleting(Member $member)
    {
        Member::withoutEvents(function() use ($member) {
            $member->deleted_id = auth()->id();
            $member->save();
        });
    }

    public function deleted(Member $member)
    {
        $member->history()->create([
            'description' => sprintf("Member <b>{$member->full_name}</b> was deleted."),
            'link' => route('users.show', auth()->id()),
            'user_id' => auth()->id(),
        ]);
    }

    public function restored(Member $member)
    {
        Member::withoutEvents(function() use ($member) {
            $member->updated_id = auth()->id();
            $member->deleted_id = null;
            $member->save();
        });

        $member->history()->create([
            'description' => sprintf("Member <b>{$member->full_name}</b> was restored."),
            'link' => route('members.show', $member),
            'user_id' => auth()->id(),
        ]);
    }

    public function forceDeleted(Member $member)
    {
        $member->history()->delete();

        $member->history()->create([
            'description' => sprintf("Member <b>{$member->full_name}</b> was destroyed."),
            'link' => route('users.show', auth()->id()),
            'user_id' => auth()->id(),
        ]);
    }
}
