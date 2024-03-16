<?php

namespace App\Http\Controllers\WorkOrderController\Show\Data;

use App\Http\Controllers\WorkOrderController\Show\Data\Kernel\DataLoaderContract;
use App\Models\WorkOrder;

class InformationLoader implements DataLoaderContract
{
    public function data(WorkOrder $work_order): array
    {
        return [
            'template' => 'information',
            'work_order' => $work_order,
        ];
    }
}
