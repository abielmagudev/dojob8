<?php

namespace App\Observers;

use App\Models\History;
use App\Models\Member;
use App\Observers\Kernel\HasObserverConstructor;

class MemberObserver
{
    use HasObserverConstructor;

    public function created(Member $member)
    {
        Member::withoutEvents(function() use ($member) {
            $member->updateCreatorUpdater();
        });

        History::create([
            'description' => sprintf("<em>{$member->full_name}</em> member was created."),
            'link' => route('members.show', $member),
            'model_type' => Member::class,
            'model_id' => $member->id,
            'user_id' => mt_rand(1,10),
        ]);
    }

    public function updated(Member $member)
    {
        Member::withoutEvents(function() use ($member) {
            $member->updateUpdater();
        });

        History::create([
            'description' => sprintf("<em>{$member->full_name}</em> member was updated."),
            'link' => route('members.show', $member),
            'model_type' => Member::class,
            'model_id' => $member->id,
            'user_id' => mt_rand(1,10),
        ]);
    }

    public function deleting(Member $member)
    {
        Member::withoutEvents(function() use ($member) {
            $member->updateDeleter();
        });
    }

    public function deleted(Member $member)
    {
        History::create([
            'description' => sprintf("<em>{$member->full_name}</em> member was deleted."),
            'link' => route('members.index'),
            'model_type' => Member::class,
            'model_id' => $member->id,
            'user_id' => mt_rand(1,10),
        ]);
    }

    public function restored(Member $member)
    {
        History::create([
            'description' => sprintf("<em>{$member->full_name}</em> member was restored."),
            'link' => route('members.show', $member),
            'model_type' => Member::class,
            'model_id' => $member->id,
            'user_id' => mt_rand(1,10),
        ]);
    }

    public function forceDeleted(Member $member)
    {
        History::create([
            'description' => sprintf("<em>{$member->full_name}</em> member was force deleted."),
            'link' => route('members.show', $member),
            'model_type' => Member::class,
            'model_id' => $member->id,
            'user_id' => mt_rand(1,10),
        ]);
    }
}
