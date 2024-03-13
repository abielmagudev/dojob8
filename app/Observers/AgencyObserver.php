<?php

namespace App\Observers;

use App\Models\Agency;

class AgencyObserver
{
    public function created(Agency $agency)
    {
        Agency::withoutEvents(function() use ($agency) {
            $agency->created_id = auth()->id();
            $agency->updated_id = auth()->id();
            $agency->save();
        });

        $agency->history()->create([
            'description' => sprintf("Agency <b>{$agency->name}</b> was created."),
            'link' => route('agencies.show', $agency),
            'user_id' => auth()->id(),
        ]);
    }

    public function updated(Agency $agency)
    {
        Agency::withoutEvents(function() use ($agency) {
            $agency->updated_id = auth()->id();
            $agency->save();
        });

        $agency->history()->create([
            'description' => sprintf("Agency <b>{$agency->name}</b> was updated."),
            'link' => route('agencies.show', $agency),
            'user_id' => auth()->id(),
        ]);
    }

    public function deleting(Agency $agency)
    {        
        Agency::withoutEvents(function() use ($agency) {
            $agency->deleted_id = auth()->id();
            $agency->save();
        });
    }

    public function deleted(Agency $agency)
    {
        $agency->history()->create([
            'description' => sprintf("Agency <b>{$agency->name}</b> was deleted."),
            'link' => route('users.show', auth()->id()),
            'user_id' => auth()->id(),
        ]);
    }
}
