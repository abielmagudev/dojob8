<?php

namespace App\Observers;

use App\Models\Configuration;
use App\Models\History;

class ConfigurationObserver
{
    public function updated(Configuration $configuration)
    {
        History::create([
            'description' => sprintf("<em>Configuration was updated."),
            'link' => route('configuration.index'),
            'model_type' => Configuration::class,
            'model_id' => $configuration->id,
            'user_id' => mt_rand(1,10),
        ]);
    }
}
