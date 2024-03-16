<?php

namespace App\Http\Controllers\WorkOrderController\Show\Data;

use App\Http\Controllers\WorkOrderController\Show\Data\Kernel\DataLoaderContract;
use App\Models\WorkOrder;

class InspectionsLoader implements DataLoaderContract
{
    public function data(WorkOrder $work_order): array
    {
        return [
            'template' => 'inspections',
            'inspections' => $work_order->inspections()->with(['agency','crew.members'])->get(),
            'work_order' => $work_order,
        ];
    }
}
