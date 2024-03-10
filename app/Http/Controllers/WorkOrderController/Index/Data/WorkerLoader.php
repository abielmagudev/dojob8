<?php

namespace App\Http\Controllers\WorkOrderController\Index\Data;

use App\Http\Controllers\WorkOrderController\Index\Data\Kernel\LoaderConstructor;
use App\Http\Controllers\WorkOrderController\Index\RequestManipulator;
use App\Http\Controllers\WorkOrderController\WorkOrderUrlGenerator;
use App\Models\WorkOrder;
use App\Models\WorkOrder\Kernel\WorkOrderStatusCatalog;
use Illuminate\Http\Request;

class WorkerLoader extends LoaderConstructor
{
    public function data()
    {
        $work_orders = WorkOrder::withEssentialRelationships()
        ->filterByParameters( $this->request->all() )
        ->hasMember( auth()->user()->profile_id )
        ->orderBy('crew_id')
        ->orderBy('ordered')
        ->paginate(35)
        ->appends( $this->request->query() );

        $work_orders_incomplete = WorkOrder::incomplete()
        ->hasMember( auth()->user()->profile_id )
        ->get();

        return [
            'filtering' => [
                'incomplete' => [
                    'url' => WorkOrderUrlGenerator::incomplete(),
                    'count' => $work_orders_incomplete->count(),
                ],
            ],
            'all_statuses' => WorkOrderStatusCatalog::all(),
            'request' => $this->request,
            'work_orders' => $work_orders,
        ];
    }
}
