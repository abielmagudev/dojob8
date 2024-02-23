<?php

namespace App\Observers;

use App\Models\Contractor;
use App\Models\History;
use App\Observers\Kernel\HasObserverConstructor;

class ContractorObserver
{
    use HasObserverConstructor;

    public function created(Contractor $contractor)
    {
        Contractor::withoutEvents(function() use ($contractor) {
            $contractor->updateCreatorUpdater();
        });

        History::create([
            'description' => sprintf("The <em>{$contractor->name}</em> contractor was created."),
            'link' => route('contractors.show', $contractor),
            'model_type' => Contractor::class,
            'model_id' => $contractor->id,
        ]);
    }

    public function updated(Contractor $contractor)
    {
        Contractor::withoutEvents(function() use ($contractor) {
            $contractor->updateUpdater();
        });

        History::create([
            'description' => sprintf("The <em>{$contractor->name}</em> contractor was updated."),
            'link' => route('contractors.show', $contractor),
            'model_type' => Contractor::class,
            'model_id' => $contractor->id,
        ]);
    }

    public function deleting(Contractor $contractor)
    {
        Contractor::withoutEvents(function() use ($contractor) {
            $contractor->updateDeleter();
        });      
    }

    public function deleted(Contractor $contractor)
    {
        History::create([
            'description' => sprintf("The <em>{$contractor->name}</em> contractor was deleted."),
            'model_type' => Contractor::class,
            'model_id' => $contractor->id,
        ]);
    }
}
