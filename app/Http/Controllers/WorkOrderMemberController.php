<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkOrderMembersUpdateRequest;
use App\Models\Crew;
use App\Models\WorkOrder;

class WorkOrderMemberController extends Controller
{
    public function __invoke(WorkOrderMembersUpdateRequest $request)
    {
        $id_active_crews = Crew::active()->pluck('id')->toArray();
        $work_orders = WorkOrder::with('crew.members')->incomplete()->whereIn('crew_id', $id_active_crews)->whereScheduledDate($request->scheduled_date)->get(); 
        
        $results = [];

        foreach($work_orders as $wo)
        {
            if( $request->keep_old_workers )
            {
                $keep_workers = $wo->members->pluck('id')->toArray();
                $result[$wo->id] = $wo->members()->syncWithoutDetaching( $wo->crew->members->except($keep_workers) );
            } 
            else
            {
                $new_workers = $wo->crew->members;
                $result[$wo->id] = $wo->members()->sync($new_workers);
            }
        }
        
        $message = array_filter($results, fn($result) => $result === false)
                 ? ['danger', "Error updating workers for work order with schedule date <b>{$request->scheduled_date}</b>, try again please"]
                 : ['success', "You updated workers of work orders with scheduled <b>{$request->scheduled_date}</b>"];

        return redirect()->route('crews.index', ['show' => $request->show])->with($message[0], $message[1]);
    }
}
