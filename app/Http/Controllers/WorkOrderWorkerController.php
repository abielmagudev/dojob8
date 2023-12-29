<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkOrderUpdateWorkersRequest;
use App\Models\WorkOrder;

class WorkOrderWorkerController extends Controller
{
    public function __invoke(WorkOrderUpdateWorkersRequest $request)
    {
        $results = [];

        $work_orders = WorkOrder::with('crew.members')->whereScheduledDate($request->scheduled_date)->get(); 

        foreach($work_orders as $wo)
        {
            if( $request->keep_old_workers )
            {
                $result[$wo->id] = $wo->workers()->syncWithoutDetaching(
                    $wo->crew->members->except( $wo->workers->pluck('id')->toArray() )
                );
            } 
            else
            {
                $result[$wo->id] = $wo->workers()->sync(
                    $wo->crew->members
                );
            }
        }
        
        $message = array_filter($results, fn($result) => $result === false)
                 ? ['danger', "Error updating workers for work order with schedule date <b>{$request->scheduled_date}</b>, try again please"]
                 : ['success', "You updated workers of work orders with scheduled <b>{$request->scheduled_date}</b>"];

        return redirect()->route('crews.index', ['show' => $request->show])->with($message[0], $message[1]);
    }
}
