<?php

namespace App\Observers;

use App\Models\History;
use App\Models\Inspection;
use App\Observers\Kernel\HasObserverConstructor;

class InspectionObserver
{
    use HasObserverConstructor;

    public function created(Inspection $inspection)
    {
        Inspection::withoutEvents(function() use ($inspection) {
            $inspection->updateCreatorUpdater();
        });

        History::create([
            'description' => sprintf("The <em>{$inspection->id}</em> inspection was created."),
            'link' => route('work-orders.show', $inspection->work_order_id),
            'model_type' => Inspection::class,
            'model_id' => $inspection->id,
        ]);
    }

    public function updated(Inspection $inspection)
    {
        Inspection::withoutEvents(function() use ($inspection) {
            $inspection->updateUpdater();
        });

        History::create([
            'description' => sprintf("The <em>{$inspection->id}</em> inspection was updated."),
            'link' => route('work-orders.show', $inspection->work_order_id),
            'model_type' => Inspection::class,
            'model_id' => $inspection->id,
        ]);
    }

    public function deleted(Inspection $inspection)
    {
        History::create([
            'description' => sprintf("The <em>{$inspection->id}</em> inspection was deleted."),
            'link' => route('work-orders.show', $inspection->work_order_id),
            'model_type' => Inspection::class,
            'model_id' => $inspection->id,
        ]);
    }
}
