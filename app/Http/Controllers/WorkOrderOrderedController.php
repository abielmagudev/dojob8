<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkOrderOrderedUpdateRequest;
use App\Models\WorkOrder;

class WorkOrderOrderedController extends Controller
{
    public function __invoke(WorkOrderOrderedUpdateRequest $request)
    {
        $updated = array();

        foreach($request->get('ordered') as $work_order_id => $order)
        {
            $updated[] = WorkOrder::where('id', $work_order_id)->update([
                'ordered' => $order,
            ]);
        }

        $message = count($updated) == count($request->get('ordered'))
                 ? ['status' => 'success', 'text' => 'Updated the order of all work orders.']
                 : ['status' => 'warning', 'text' => 'Updated the order of some work orders.'];
        
        return redirect($request->get('url_back'))->with($message['status'], $message['text']);
    }
}
