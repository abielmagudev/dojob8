<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkOrderUpdateMembersRequest;
use App\Models\WorkOrder;

class MemberWorkOrderController extends Controller
{
    public function __invoke(WorkOrderUpdateMembersRequest $request)
    {
        $results = [];

        $work_orders = WorkOrder::with('crew.members')->whereScheduledDate($request->scheduled_date)->get(); 

        foreach($work_orders as $wo)
        {
            if( $request->keep_old_workers )
            {
                $result[$wo->id] = $wo->members()->syncWithoutDetaching(
                    $wo->crew->members->except( $wo->members->pluck('id')->toArray() )
                );
            } 
            else
            {
                $result[$wo->id] = $wo->members()->sync(
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
