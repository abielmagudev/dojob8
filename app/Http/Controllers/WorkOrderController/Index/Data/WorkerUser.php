<?php

namespace App\Http\Controllers\WorkOrderController\Index\Data;

use App\Http\Controllers\WorkOrderController\WorkOrderUrlGenerator;
use App\Models\WorkOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkerUser
{
    public static function data(Request $request)
    {
        if( empty($request->except('page')) ) {
            $request->merge(['scheduled_date' => Carbon::today()->format('Y-m-d')]);
        }

        $work_orders = WorkOrder::withEssentialRelationships()
        ->filterByParameters( $request->all() )
        ->hasMember( auth()->user()->profile_id )
        ->orderBy('crew_id')
        ->orderBy('ordered')
        ->paginate(35)
        ->appends( $request->query() );

        $work_orders_incomplete = WorkOrder::incomplete()
        ->hasMember( auth()->user()->profile_id )
        ->get();

        return [
            'filtering' => [
                'not-done' => [
                    'url' => WorkOrderUrlGenerator::incomplete(),
                    'count' => $work_orders_incomplete->count(),
                ],
            ],
            'request' => $request,
            'work_orders' => $work_orders,
        ];
    }
}
