<?php

namespace App\Observers;

use App\Models\Job;

class JobObserver
{
    public function created(Job $job)
    {
        Job::withoutEvents(function() use ($job) {
            $job->created_id = auth()->id();
            $job->updated_id = auth()->id();
            $job->save();
        });

        $job->history()->create([
            'description' => sprintf("Job <b>{$job->name}</b> was created."),
            'link' => route('jobs.show', $job),
            'user_id' => auth()->id(),
        ]);
    }

    public function updated(Job $job)
    {
        Job::withoutEvents(function() use ($job) {
            $job->updated_id = auth()->id();
            $job->save();
        });

        $job->history()->create([
            'description' => sprintf("Job <b>{$job->name}</b> was updated."),
            'link' => route('jobs.show', $job),
            'user_id' => auth()->id(),
        ]);
    }

    public function deleting(Job $job)
    {
        Job::withoutEvents(function() use ($job) {
            $job->deleted_id = auth()->id();
            $job->save();
        });
    }

    public function deleted(Job $job)
    {
        $job->history()->create([
            'description' => sprintf("Job <b>{$job->name}</b> was deleted."),
            'link' => route('users.show', auth()->id()),
            'user_id' => auth()->id(),
        ]);
    }
}
