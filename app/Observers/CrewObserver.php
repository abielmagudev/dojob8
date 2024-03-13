<?php

namespace App\Observers;

use App\Models\Crew;

class CrewObserver
{
    public function created(Crew $crew)
    {
        Crew::withoutEvents(function() use ($crew) {
            $crew->created_id = auth()->id();
            $crew->updated_id = auth()->id();
            $crew->save();
        });

        $crew->history()->create([
            'description' => sprintf("Crew <b>{$crew->name}</b> was created."),
            'link' => route('crews.show', $crew),
            'user_id' => auth()->id(),
        ]);
    }

    public function updated(Crew $crew)
    {
        Crew::withoutEvents(function() use ($crew) {
            $crew->updated_id = auth()->id();
            $crew->save();
        });

        $crew->history()->create([
            'description' => sprintf("Crew <b>{$crew->name}</b> was updated."),
            'link' => route('crews.show', $crew),
            'user_id' => auth()->id(),
        ]);
    }

    public function deleting(Crew $crew)
    {
        Crew::withoutEvents(function() use ($crew) {
            $crew->deleted_id = auth()->id();
            $crew->save();
        });
    }

    public function deleted(Crew $crew)
    {
        $crew->history()->create([
            'description' => sprintf("Crew <b>{$crew->name}</b> was deleted."),
            'link' => route('users.show', auth()->id()),
            'user_id' => auth()->id(),
        ]);
    }
}
