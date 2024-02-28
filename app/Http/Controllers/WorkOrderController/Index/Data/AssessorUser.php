<?php

namespace App\Http\Controllers\WorkOrderController\Index\Data;

use App\Models\WorkOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AssessorUser
{
    public static function data(Request $request)
    {
        if(! $request->filled('scheduled_date') ) {
            $request->merge(['scheduled_date' => Carbon::today()->format('Y-m-d')]);
        }

        $work_orders = WorkOrder::withAllRelationships()
        ->whereHas('members', function ($query) use ($request) {
            $query->where('scheduled_date', $request->get('scheduled_date'));
        })
        ->orderBy('crew_id')
        ->orderBy('ordered')
        ->paginate(35)
        ->appends( $request->query() );

        return [
            'request' => $request,
            'work_orders' => $work_orders,
        ];
    }
}
