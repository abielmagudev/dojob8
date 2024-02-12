<?php

namespace App\Observers;

use App\Models\History;
use App\Models\WorkOrder;
use App\Observers\Kernel\HasObserverConstructor;

class WorkOrderObserver
{
    use HasObserverConstructor;

    public function created(WorkOrder $work_order)
    {
        WorkOrder::withoutEvents(function() use ($work_order) {
            $work_order->updateCreatorUpdater();
        });

        History::create([
            'description' => sprintf("The work order <em>{$work_order->id} - {$work_order->job->name}</em> was created."),
            'link' => route('work-orders.show', $work_order),
            'model_type' => WorkOrder::class,
            'model_id' => $work_order->id,
            'user_id' => mt_rand(1,10),
        ]);
    }

    public function updated(WorkOrder $work_order)
    {
        WorkOrder::withoutEvents(function() use ($work_order) {
            $work_order->updateUpdater();
        });

        History::create([
            'description' => sprintf("The work order <em>{$work_order->id} - {$work_order->job->name}</em> was updated."),
            'link' => route('work-orders.show', $work_order),
            'model_type' => WorkOrder::class,
            'model_id' => $work_order->id,
            'user_id' => mt_rand(1,10),
        ]);
    }

    public function deleted(WorkOrder $work_order)
    {
        History::create([
            'description' => sprintf("The work order <em>{$work_order->id} - {$work_order->job->name}</em> was deleted."),
            'model_type' => WorkOrder::class,
            'model_id' => $work_order->id,
            'user_id' => mt_rand(1,10),
        ]);
    }
}
