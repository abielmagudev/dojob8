<?php

namespace App\Http\Controllers\WorkOrderController\Index\Data;

use App\Http\Controllers\WorkOrderController\Index\Data\Kernel\DataLoaderContract;
use App\Models\WorkOrder;
use App\Models\WorkOrder\Kernel\WorkOrderStatusCatalog;
use Illuminate\Http\Request;

class ContractorLoader implements DataLoaderContract
{
    public function data(Request $request): array
    {
        $paramter_for_filters = $this->getParameterForFilters($request);

        $work_orders = WorkOrder::withEssentialRelationships()
        ->filterByParameters( $paramter_for_filters )
        ->orderBy('scheduled_date', $request->get('sort', 'desc'))
        ->paginate(35)
        ->appends( $request->query() );

        return [
            'filtering' => [
                'incomplete' => [
                    'url' => workOrderUrlGenerator('incomplete'),
                    'count' => WorkOrder::incomplete()
                                        ->whereNotNull('scheduled_date')
                                        ->whereNotNull('crew_id')
                                        ->where('contractor_id', auth()->user()->profile_id)
                                        ->count(),
                ],
            ],
            'all_statuses' => WorkOrderStatusCatalog::all(),
            'request' => $request,
            'work_orders' => $work_orders,
        ];
    }

    protected function getParameterForFilters(Request $request)
    {
        $only = $request->only([
            'dates',
            'scheduled_date',
            'sort',
            'status_group',
        ]);

        return array_merge($only, [
            'contractor' => auth()->user()->profile_id,
            'pending' => 0,
        ]);
    }
}
