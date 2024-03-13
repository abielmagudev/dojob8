<?php

namespace App\Observers;

use App\Models\Assessment;

class AssessmentObserver
{
    public function created(Assessment $assessment)
    {
        Assessment::withoutEvents(function() use ($assessment) {
            $assessment->created_id = auth()->id();
            $assessment->updated_id = auth()->id();
            $assessment->save();
        });

        $assessment->history()->create([
            'description' => sprintf("Assessment <b>{$assessment->id}</b> was created."),
            'link' => route('assessments.show', $assessment),
            'user_id' => auth()->id(),
        ]);
    }

    public function updated(Assessment $assessment)
    {
        Assessment::withoutEvents(function() use ($assessment) {
            $assessment->updated_id = auth()->id();
            $assessment->save();
        });

        $assessment->history()->create([
            'description' => sprintf("Assessment <b>{$assessment->id}</b> was updated."),
            'link' => route('assessments.show', $assessment),
            'user_id' => auth()->id(),
        ]);
    }

    public function deleted(Assessment $assessment)
    {
        $assessment->history()->delete();

        $assessment->history()->create([
            'description' => sprintf("Assessment <b>{$assessment->id}</b> was deleted."),
            'link' => route('users.show', auth()->id()),
            'user_id' => auth()->id(),
        ]);
    }
}
