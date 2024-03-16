<?php

namespace App\Http\Controllers\WorkOrderController\Index\Data;

use App\Http\Controllers\WorkOrderController\Index\Data\Kernel\DataLoaderContract;
use App\Http\Controllers\WorkOrderController\WorkOrderUrlGenerator;
use App\Models\WorkOrder;
use App\Models\WorkOrder\Kernel\WorkOrderStatusCatalog;
use App\Models\WorkOrder\Kernel\WorkOrderTypeCatalog;
use Illuminate\Http\Request;

class CrewMemberLoader implements DataLoaderContract
{
    public function data(Request $request): array
    {
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
                'incomplete' => [
                    'url' => workOrderUrlGenerator('incomplete'),
                    'count' => $work_orders_incomplete->count(),
                ],
            ],
            'all_statuses' => WorkOrderStatusCatalog::all(),
            'all_types' => WorkOrderTypeCatalog::all(),
            'request' => $request,
            'work_orders' => $work_orders,
        ];
    }
}
