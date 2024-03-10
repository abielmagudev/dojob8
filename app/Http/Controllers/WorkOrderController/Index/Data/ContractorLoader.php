<?php

namespace App\Http\Controllers\WorkOrderController\Index\Data;

use App\Http\Controllers\WorkOrderController\Index\Data\Kernel\LoaderConstructor;
use App\Models\WorkOrder;

class ContractorLoader extends LoaderConstructor
{
    public function data()
    {
        $paramter_for_filters = $this->getParameterForFilters();

        $work_orders = WorkOrder::withEssentialRelationships()
        ->filterByParameters( $paramter_for_filters )
        ->orderBy('scheduled_date', $this->request->get('sort', 'desc'))
        ->paginate(35)
        ->appends( $this->request->query() );

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
            'all_statuses' => WorkOrder::collectionAllStatuses(),
            'request' => $this->request,
            'work_orders' => $work_orders,
        ];
    }

    protected function getParameterForFilters()
    {
        $only = $this->request->only([
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
