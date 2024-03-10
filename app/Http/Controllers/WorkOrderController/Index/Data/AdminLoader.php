<?php

namespace App\Http\Controllers\WorkOrderController\Index\Data;

use App\Http\Controllers\WorkOrderController\Index\Data\Kernel\LoaderConstructor;
use App\Http\Controllers\WorkOrderController\WorkOrderUrlGenerator;
use App\Models\Contractor;
use App\Models\Crew;
use App\Models\Job;
use App\Models\WorkOrder;

class AdminLoader extends LoaderConstructor
{
    public function data()
    {
        $work_orders = WorkOrder::withEssentialRelationships()
        ->filterByParameters( $this->request->all() )
        ->orderBy('crew_id')
        ->orderBy('scheduled_date', $this->request->get('sort', 'desc'))
        ->orderByRaw('ordered IS NULL, ordered asc')
        ->paginate(35)
        ->appends( $this->request->query() );

        return [
            'filtering' => [
                'contractors' => Contractor::orderBy('name', 'desc')->get(),
                'crews' => Crew::purposeWorkOrders()->active()->orderBy('name', 'desc')->get(),
                'jobs' => Job::orderBy('name', 'desc')->get(),
                'pending' => [
                    'url' => WorkOrderUrlGenerator::pending(),
                    'count' => WorkOrder::pending()->count(),
                ],
                'incomplete' => [
                    'url' => WorkOrderUrlGenerator::incomplete(),
                    'count' => WorkOrder::incomplete()->count(),
                ],
            ], 
            'all_statuses' => WorkOrder::collectionAllStatuses(),
            'all_types' => WorkOrder::collectionAllTypes(),
            'request' => $this->request,
            'work_orders' => $work_orders,
        ];
    }
}
