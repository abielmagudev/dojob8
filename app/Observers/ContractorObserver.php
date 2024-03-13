<?php

namespace App\Observers;

use App\Models\Contractor;

class ContractorObserver
{
    public function created(Contractor $contractor)
    {
        Contractor::withoutEvents(function() use ($contractor) {
            $contractor->created_id = auth()->id();
            $contractor->updated_id = auth()->id();
            $contractor->save();
        });

        $contractor->history()->create([
            'description' => sprintf("Contractor <b>{$contractor->name}</b> was created."),
            'link' => route('contractors.show', $contractor),
            'user_id' => auth()->id(),
        ]);
    }

    public function updated(Contractor $contractor)
    {
        Contractor::withoutEvents(function() use ($contractor) {
            $contractor->updated_id = auth()->id();
            $contractor->save();
        });

        $contractor->history()->create([
            'description' => sprintf("Contractor <b>{$contractor->name}</b> was updated."),
            'link' => route('contractors.show', $contractor),
            'user_id' => auth()->id(),
        ]);
    }

    public function deleting(Contractor $contractor)
    {
        Contractor::withoutEvents(function() use ($contractor) {
            $contractor->deleted_id = auth()->id();
            $contractor->save();
        }); 
    }

    public function deleted(Contractor $contractor)
    {
        $contractor->history()->create([
            'description' => sprintf("Contractor <b>{$contractor->name}</b> was deleted."),
            'link' => route('users.show', auth()->id()),
            'user_id' => auth()->id(),
        ]);
    }
}
