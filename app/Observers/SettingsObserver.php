<?php

namespace App\Observers;

use App\Models\History;
use App\Models\Settings;

class SettingsObserver
{
    public function created(Settings $settings)
    {
        Settings::withoutEvents(function() use ($settings) {
            $settings->created_id = auth()->id();
            $settings->updated_id = auth()->id();
            $settings->save();
        });

        $settings->history()->create([
            'description' => "Settings <b>{$settings->id}</b> was created.",
            'link' => route('settings.index'),
            'user_id' => auth()->id(),
        ]);
    }

    public function updated(Settings $settings)
    {
        Settings::withoutEvents(function() use ($settings) {
            $settings->updated_id = auth()->id();
            $settings->save();
        });

        $settings->history()->create([
            'description' => "Settings <b>{$settings->id}</b> was updated.",
            'link' => route('settings.index'),
            'user_id' => auth()->id(),
        ]);
    }
}
