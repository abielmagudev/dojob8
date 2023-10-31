<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderJobExtensionsAjaxController extends Controller
{
    public function create(Request $request, Job $job)
    {
        return response()->json([
            'job' => $job,
            'status' => 200,
            'templates' => $job->extensions->map(function ($extension) {
                return (app($extension->orderController)->callAction('create', [$extension]))->render();
            }),
        ], 200);
    }

    public function edit(Request $request, Order $order)
    {
        return response()->json([
            'order' => $order,
            'status' => 200,
            'templates' => $order->job->extensions->map(function ($extension) use ($order) {
                return (app($extension->orderController)->callAction('create', [$extension, $order]))->render();
            }),
        ], 200);
    }
}
