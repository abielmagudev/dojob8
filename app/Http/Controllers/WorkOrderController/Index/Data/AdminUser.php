<?php

namespace App\Http\Controllers\WorkOrderController\Index\Data;

use App\Http\Controllers\WorkOrderController\WorkOrderUrlGenerator;
use App\Models\Contractor;
use App\Models\Crew;
use App\Models\Job;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class AdminUser
{
    public static function data(Request $request)
    {
        $work_orders = WorkOrder::withAllRelationships()
        ->filterByParameters( $request->all() )
        ->orderBy('crew_id')
        ->orderBy('scheduled_date', $request->get('sort', 'desc'))
        ->orderByRaw('ordered IS NULL, ordered asc')
        ->paginate(35)
        ->appends( $request->query() );

        return [
            'filtering' => [
                'contractors' => Contractor::orderBy('name', 'desc')->get(),
                'crews' => Crew::taskWorkOrders()->active()->orderBy('name', 'desc')->get(),
                'jobs' => Job::orderBy('name', 'desc')->get(),
                'incomplete' => [
                    'url' => WorkOrderUrlGenerator::incomplete(),
                    'count' => WorkOrder::incomplete(false)->count(),
                ],
            ], 
            'all_statuses' => WorkOrder::getAllStatuses(),
            'all_types' => WorkOrder::getAllTypes(),
            'request' => $request,
            'work_orders' => $work_orders,
        ];
    }
}
