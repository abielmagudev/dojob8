<?php

namespace App\Observers;

use App\Models\History;
use App\Models\WorkOrder;

class WorkOrderObserver
{
    public function created(WorkOrder $work_order)
    {
        WorkOrder::withoutEvents(function() use ($work_order) {
            $work_order->created_id = auth()->id();
            $work_order->updated_id = auth()->id();
            $work_order->save();
        });

        $work_order->history()->create([
            'description' => "Work order <b>{$work_order->id} - {$work_order->job->name}</b> was created.",
            'link' => route('work-orders.show', $work_order),
            'user_id' => auth()->id(),
        ]);
    }

    public function updated(WorkOrder $work_order)
    {
        WorkOrder::withoutEvents(function() use ($work_order) {
            $work_order->updated_id = auth()->id();
            $work_order->save();
        });

        $work_order->history()->create([
            'description' => "Work order <b>{$work_order->id} - {$work_order->job->name}</b> was updated.",
            'link' => route('work-orders.show', $work_order),
            'user_id' => auth()->id(),
        ]);
    }

    public function deleted(WorkOrder $work_order)
    {
        $work_order->history()->delete();

        $work_order->history()->create([
            'description' => "Work order <b>{$work_order->id} - {$work_order->job->name}</b> was deleted.",
            'link' => route('work-orders.show', $work_order),
            'user_id' => auth()->id(),
        ]);
    }
}
