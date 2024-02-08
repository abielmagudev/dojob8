<?php

namespace App\Observers;

use App\Models\Crew;
use App\Models\History;
use App\Observers\Kernel\HasObserverConstructor;

class CrewObserver
{
    use HasObserverConstructor;

    public function created(Crew $crew)
    {
        Crew::withoutEvents(function() use ($crew) {
            $crew->updateCreatorUpdater();
        });

        History::create([
            'description' => sprintf("The <em>{$crew->name}</em> crew was created."),
            'link' => route('crews.show', $crew),
            'model_type' => Crew::class,
            'model_id' => $crew->id,
            'user_id' => mt_rand(1,10),
        ]);
    }

    public function updated(Crew $crew)
    {
        Crew::withoutEvents(function() use ($crew) {
            $crew->updateUpdater();
        });

        History::create([
            'description' => sprintf("The <em>{$crew->name}</em> crew was updated."),
            'link' => route('crews.show', $crew),
            'model_type' => Crew::class,
            'model_id' => $crew->id,
            'user_id' => mt_rand(1,10),
        ]);
    }

    public function deleting(Crew $crew)
    {
        Crew::withoutEvents(function() use ($crew) {
            $crew->updateDeleter();
        });
    }

    public function deleted(Crew $crew)
    {
        History::create([
            'description' => sprintf("<em>{$crew->name}</em> crew was deleted."),
            'model_type' => Crew::class,
            'model_id' => $crew->id,
            'user_id' => mt_rand(1,10),
        ]);
    }
}
