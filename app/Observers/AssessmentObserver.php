<?php

namespace App\Observers;

use App\Models\Assessment;

class AssessmentObserver
{
    public function created(Assessment $assessment)
    {
        Assessment::withoutEvents(function() use ($assessment) {
            $assessment->created_by = auth()->id();
            $assessment->updated_by = auth()->id();
            $assessment->save();
        });

        $assessment->history()->create([
            'description' => sprintf("<em>{$assessment->id}</em> assessment was created."),
            'link' => route('assessments.show', $assessment),
            'user_id' => auth()->id(),
        ]);
    }

    public function updated(Assessment $assessment)
    {
        Assessment::withoutEvents(function() use ($assessment) {
            $assessment->updated_by = auth()->id();
            $assessment->save();
        });

        $assessment->history()->create([
            'description' => sprintf("<em>{$assessment->id}</em> assessment was updated."),
            'link' => route('assessments.show', $assessment),
            'user_id' => auth()->id(),
        ]);
    }

    public function deleted(Assessment $assessment)
    {
        $assessment->history()->delete();

        $assessment->history()->create([
            'description' => sprintf("<em>{$assessment->id}</em> assessment was deleted."),
            'user_id' => auth()->id(),
        ]);
    }
}
