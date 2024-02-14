<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkOrderStatusUpdateRequest;
use App\Models\WorkOrder;

class WorkOrderStatusController extends Controller
{
    public function __invoke(WorkOrderStatusUpdateRequest $request)
    {
        $result = WorkOrder::whereIn('id', $request->get('work_orders'))->update(['status' => $request->get('status')]);
        $status_uppercase = strtoupper($request->get('status'));

        if( $result === false ) {
            return redirect($request->url_back)->with('danger', "Error updating work order status <b>{$status_uppercase}</b>, try again...");
        }

        $comparison_updated = sprintf('%s/%s', count($request->get('work_orders')), $result);

        return redirect($request->url_back)->with('success', "{$comparison_updated} Work orders were updated with status <b>{$status_uppercase}</b>");
    }
}
