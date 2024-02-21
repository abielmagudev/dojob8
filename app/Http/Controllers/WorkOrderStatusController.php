<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkOrderStatusUpdateRequest;
use App\Models\History;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class WorkOrderStatusController extends Controller
{
    public function __invoke(WorkOrderStatusUpdateRequest $request)
    {
        $status_uppercase = strtoupper($request->get('status'));

        $result = WorkOrder::whereIn('id', $request->get('work_orders'))->noPendingStatus()->update(['status' => $request->get('status')]);

        if( $result === false ) {
            return redirect($request->url_back)->with('danger', "Error updating work order status <b>{$status_uppercase}</b>, try again...");
        }

        $this->history($request);

        $comparison_updated = sprintf('%s/%s', count($request->get('work_orders')), $result);

        return redirect($request->url_back)->with('success', "{$comparison_updated} Work orders were updated with status <b>{$status_uppercase}</b>");
    }

    private function history(Request $request)
    {
        $work_orders = WorkOrder::whereIn('id', $request->get('work_orders'))->get();

        $data = $work_orders->map(function($wo) use ($request) {
            return [
                'description' => sprintf('Work order %s status updated to <b>%s</b>', $wo->id, $request->get('status')),
                'link' => route('work-orders.show', $wo),
                'model_type' => WorkOrder::class,
                'model_id' => $wo->id,
                'user_id' => mt_rand(1,10),
            ];
        })->toArray();

        return History::insert($data);
    }
}
