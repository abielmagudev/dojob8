<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class WorkOrderJobExtensionsAjaxController extends Controller
{
    public function create(Request $request, Job $job)
    {
        return response()->json([
            'job' => $job,
            'status' => 200,
            'templates' => $job->extensions->map(function ($extension) {
                return (app($extension->xapi_work_order_controller)->callAction('create', [$extension]))->render();
            }),
        ], 200);
    }

    public function show(Request $request, WorkOrder $work_order)
    {
        return response()->json([
            'work_order' => $work_order,
            'status' => 200,
            'templates' => $work_order->job->extensions->map(function ($extension) use ($work_order) {
                return (app($extension->xapi_work_order_controller)->callAction('show', [$extension, $work_order]))->render();
            }),
        ], 200);
    }

    public function edit(Request $request, WorkOrder $work_order)
    {
        return response()->json([
            'work_order' => $work_order,
            'status' => 200,
            'templates' => $work_order->job->extensions->map(function ($extension) use ($work_order) {
                return (app($extension->xapi_work_order_controller)->callAction('edit', [$extension, $work_order]))->render();
            }),
        ], 200);
    }
}
