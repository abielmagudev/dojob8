<?php

namespace App\Observers;

use App\Models\Agency;
use App\Models\History;
use App\Observers\Kernel\HasObserverConstructor;

class AgencyObserver
{
    use HasObserverConstructor;

    public function created(Agency $agency)
    {
        Agency::withoutEvents(function() use ($agency) {
            $agency->updateCreatorUpdater();
        });

        History::create([
            'description' => sprintf("The <em>{$agency->name}</em> agency was created."),
            'link' => route('agencies.show', $agency),
            'model_type' => Agency::class,
            'model_id' => $agency->id,
            'user_id' => mt_rand(1,10),
        ]);
    }

    public function updated(Agency $agency)
    {
        Agency::withoutEvents(function() use ($agency) {
            $agency->updateUpdater();
        });

        History::create([
            'description' => sprintf("The <em>{$agency->name}</em> agency was updated."),
            'link' => route('agencies.show', $agency),
            'model_type' => Agency::class,
            'model_id' => $agency->id,
            'user_id' => mt_rand(1,10),
        ]);
    }

    public function deleting(Agency $agency)
    {
        Agency::withoutEvents(function() use ($agency) {
            $agency->updateDeleter();
        });
    }

    public function deleted(Agency $agency)
    {
        History::create([
            'description' => sprintf("The <em>{$agency->name}</em> agency was deleted."),
            'model_type' => Agency::class,
            'model_id' => $agency->id,
            'user_id' => mt_rand(1,10),
        ]);
    }
}
