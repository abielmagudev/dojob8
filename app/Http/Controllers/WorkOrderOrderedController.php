<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkOrderOrderedUpdateRequest;
use App\Models\WorkOrder;

class WorkOrderOrderedController extends Controller
{
    public function __invoke(WorkOrderOrderedUpdateRequest $request)
    {
        $this->authorize('update', WorkOrder::class);

        $result = collect([]);

        foreach($request->get('ordered') as $work_order_id => $order)
        {
            $updated = WorkOrder::where('id', $work_order_id)->update([
                'ordered' => $order,
            ]);

            $result->push($updated);
        }

        // if( $result === false ) {
        //     return redirect($request->url_back)->with('danger', "Error updating work order order, try again...");
        // }

        $comparison_updated = sprintf('%s/%s', count($request->get('ordered')), $result->filter()->count());

        return redirect($request->get('url_back'))->with('success', "{$comparison_updated} Work orders were updated with order");
    }
}
