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

        $message = $result === false
                 ? ['warning', sprintf('Error updating work order status <b>%s</b>, try again...', $status_uppercase)]
                 : ['success', sprintf('%s Work orders were updated with status <b>%s</b>', $result, $status_uppercase)];

        return redirect($request->url_back)->with($message[0], $message[1]);
    }
}
