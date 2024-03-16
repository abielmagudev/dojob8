<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkOrderUpdateQuicklyRequest;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class WorkOrderUpdateQuicklyController extends Controller
{
    public $actions = [
        'ordering' => 'updateOrdering',
        'schedule' => 'updateSchedule',
        'status' => 'updateStatus',
    ];

    public function __invoke(WorkOrderUpdateQuicklyRequest $request, string $attribute)
    {
        // $this->authorize('update', WorkOrder::class);

        return call_user_func([$this, $this->actions[$attribute]], $request);
    }

    
    // Update order

    protected function updateOrdering(WorkOrderUpdateQuicklyRequest $request)
    {
        $collection = collect( $request->get('work_orders', []) );

        $work_orders = WorkOrder::whereIn('id', $collection->keys())->get();

        $work_orders->each(function ($wo) use ($collection)
        {
            $value = $collection->get($wo->id);

            if( $wo->ordered <> $value )
            {
                $wo->ordered = $value;
                $wo->save();
            }
        });

        return redirect( $request->get('url_back') )->with('success', 'The ordering of work orders has been updated');
    }


    // Update scheduled date

    protected function updateSchedule(WorkOrderUpdateQuicklyRequest $request)
    {
        $work_orders = WorkOrder::whereIn('id', $request->get('work_orders', []));
        $value = $request->get('scheduled_date');

        $work_orders->each(function ($wo) use ($value)
        {
            if( $wo->scheduled_date <> $value )
            {
                $wo->scheduled_date = $value;
                $wo->save();
            }
        });

        return redirect( $request->get('url_back') )->with('success', "The schedule date of selected work orders has been updated to <b>{$value}</b>");
    }


    // Update status

    protected function updateStatus(Request $request)
    {
        $work_orders = WorkOrder::whereIn('id', $request->get('work_orders', []));
        $value = $request->get('status');

        $work_orders->each(function ($wo) use ($value)
        {
            if( $wo->status <> $value )
            {
                $wo->status = $value;
                $wo->save();
            }
        });

        return redirect( $request->get('url_back') )->with('success', "The status of selected work orders has been updated to <b>{$value}</b>");
    }
}
