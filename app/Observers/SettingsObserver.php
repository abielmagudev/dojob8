<?php

namespace App\Observers;

use App\Models\History;
use App\Models\Settings;
use App\Observers\Kernel\HasObserverConstructor;

class SettingsObserver
{
    use HasObserverConstructor;

    public function created(Settings $settings)
    {
        Settings::withoutEvents(function() use ($settings) {
            $settings->updateCreatorUpdater();
        });

        History::create([
            'description' => sprintf("<em>Settings</em> was created."),
            'link' => route('settings.index'),
            'model_type' => Settings::class,
            'model_id' => $settings->id,
        ]);
    }

    public function updated(Settings $settings)
    {
        Settings::withoutEvents(function() use ($settings) {
            $settings->updateUpdater();
        });

        History::create([
            'description' => sprintf("<em>Settings</em> was updated."),
            'link' => route('settings.index'),
            'model_type' => Settings::class,
            'model_id' => $settings->id,
        ]);
    }
}
