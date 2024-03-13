<?php

namespace App\Observers;

use App\Models\Inspection;

class InspectionObserver
{
    public function created(Inspection $inspection)
    {
        Inspection::withoutEvents(function() use ($inspection) {
            $inspection->created_id = auth()->id();
            $inspection->updated_id = auth()->id();
            $inspection->save();
        });

        $inspection->history()->create([
            'description' => sprintf("Inspection <b>{$inspection->id}</b> was created."),
            'link' => route('work-orders.show', $inspection->work_order_id),
            'user_id' => auth()->id(),
        ]);
    }

    public function updated(Inspection $inspection)
    {
        Inspection::withoutEvents(function() use ($inspection) {
            $inspection->updated_id = auth()->id();
            $inspection->save();
        });

        $inspection->history()->create([
            'description' => sprintf("Inspection <b>{$inspection->id}</b> was updated."),
            'link' => route('work-orders.show', $inspection->work_order_id),
            'user_id' => auth()->id(),
        ]);
    }

    public function deleted(Inspection $inspection)
    {
        $inspection->history()->delete();

        $inspection->history()->create([
            'description' => sprintf("Inspection <b>{$inspection->id}</b> was deleted."),
            'link' => route('users.show', auth()->id()),
            'user_id' => auth()->id(),
        ]);
    }
}
