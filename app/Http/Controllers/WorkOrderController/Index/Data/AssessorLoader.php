<?php

namespace App\Http\Controllers\WorkOrderController\Index\Data;

use App\Http\Controllers\WorkOrderController\Index\Data\Kernel\DataLoaderContract;
use App\Models\Contractor;
use App\Models\Crew;
use App\Models\Job;
use App\Models\WorkOrder;
use App\Models\WorkOrder\Kernel\WorkOrderStatusCatalog;
use App\Models\WorkOrder\Kernel\WorkOrderTypeCatalog;
use Illuminate\Http\Request;

class AssessorLoader implements DataLoaderContract
{
    public function data(Request $request): array
    {
        $work_orders = WorkOrder::withEssentialRelationships()
        ->filterByParameters( $request->all() )
        ->orderBy('crew_id')
        ->orderBy('scheduled_date', $request->get('sort', 'desc'))
        ->orderByRaw('ordered IS NULL, ordered asc')
        ->paginate(35)
        ->appends( $request->query() );

        return [
            'filtering' => [
                'contractors' => Contractor::orderBy('name', 'desc')->get(),
                'crews' => Crew::task('work orders')->active()->orderBy('name', 'desc')->get(),
                'jobs' => Job::orderBy('name', 'desc')->get(),
                'pending' => [
                    'url' => workOrderUrlGenerator('pending'),
                    'count' => WorkOrder::pending()->count(),
                ],
                'incomplete' => [
                    'url' => workOrderUrlGenerator('incomplete'),
                    'count' => WorkOrder::incomplete()->count(),
                ],
            ], 
            'all_statuses' => WorkOrderStatusCatalog::all(),
            'all_types' => WorkOrderTypeCatalog::all(),
            'request' => $request,
            'work_orders' => $work_orders,
        ];
    }
}
