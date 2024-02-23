<?php

namespace App\Observers;

use App\Models\History;
use App\Models\Job;
use App\Observers\Kernel\HasObserverConstructor;

class JobObserver
{
    use HasObserverConstructor;

    public function created(Job $job)
    {
        Job::withoutEvents(function() use ($job) {
            $job->updateCreatorUpdater();
        });

        History::create([
            'description' => sprintf("The <em>{$job->name}</em> job was created."),
            'link' => route('jobs.show', $job),
            'model_type' => Job::class,
            'model_id' => $job->id,
        ]);
    }

    public function updated(Job $job)
    {
        Job::withoutEvents(function() use ($job) {
            $job->updateUpdater();
        });

        History::create([
            'description' => sprintf("The <em>{$job->name}</em> job was updated."),
            'link' => route('jobs.show', $job),
            'model_type' => Job::class,
            'model_id' => $job->id,
        ]);
    }

    public function deleting(Job $job)
    {
        Job::withoutEvents(function() use ($job) {
            $job->updateDeleter();
        });
    }

    public function deleted(Job $job)
    {
        History::create([
            'description' => sprintf("The <em>{$job->name}</em> job was deleted."),
            'model_type' => Job::class,
            'model_id' => $job->id,
        ]);
    }
}
