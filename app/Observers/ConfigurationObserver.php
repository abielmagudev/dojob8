<?php

namespace App\Observers;

use App\Models\Configuration;
use App\Models\History;

class ConfigurationObserver
{
    public function created(Configuration $configuration)
    {
        History::create([
            'description' => sprintf("<em>Configuration</em> was created."),
            'link' => route('configuration.index'),
            'model_type' => Configuration::class,
            'model_id' => $configuration->id,
            'user_id' => mt_rand(1,10),
        ]);
    }

    public function updated(Configuration $configuration)
    {
        History::create([
            'description' => sprintf("<em>Configuration</em> was updated."),
            'link' => route('configuration.index'),
            'model_type' => Configuration::class,
            'model_id' => $configuration->id,
            'user_id' => mt_rand(1,10),
        ]);
    }
}
