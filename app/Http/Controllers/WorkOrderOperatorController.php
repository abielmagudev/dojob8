<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkOrderUpdateOperatorsRequest;
use App\Models\WorkOrder;

class WorkOrderOperatorController extends Controller
{
    public function __invoke(WorkOrderUpdateOperatorsRequest $request)
    {
        $results = [];

        $work_orders = WorkOrder::with('crew.members')->whereScheduledDate($request->scheduled_date)->get(); 

        foreach($work_orders as $wo)
        {
            if( $request->keep_old_operators )
            {
                $result[$wo->id] = $wo->operators()->syncWithoutDetaching(
                    $wo->crew->members->except( $wo->operators->pluck('id')->toArray() )
                );
            } 
            else
            {
                $result[$wo->id] = $wo->operators()->sync(
                    $wo->crew->members
                );
            }
        }
        
        $message = array_filter($results, fn($result) => $result === false)
                 ? ['danger', "Error updating operators for work order with schedule date <b>{$request->scheduled_date}</b>, try again please"]
                 : ['success', "You updated operators of work orders with scheduled <b>{$request->scheduled_date}</b>"];

        return redirect()->route('crews.index', ['show' => $request->show])->with($message[0], $message[1]);
    }
}
