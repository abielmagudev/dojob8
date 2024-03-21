<?php

namespace App\Observers;

use App\Models\Configuration;

class ConfigurationObserver
{
    public function created(Configuration $configuration)
    {
        Configuration::withoutEvents(function() use ($configuration) {
            $configuration->created_id = auth()->id();
            $configuration->updated_id = auth()->id();
            $configuration->save();
        });

        $configuration->history()->create([
            'description' => "Configuration <b>{$configuration->id}</b> was created.",
            'link' => route('configuration.index'),
            'user_id' => auth()->id(),
        ]);
    }

    public function updated(Configuration $configuration)
    {
        Configuration::withoutEvents(function() use ($configuration) {
            $configuration->updated_id = auth()->id();
            $configuration->save();
        });

        $configuration->history()->create([
            'description' => "Configuration <b>{$configuration->id}</b> was updated.",
            'link' => route('configuration.index'),
            'user_id' => auth()->id(),
        ]);
    }
}
