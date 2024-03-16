<?php

namespace App\Http\Controllers\WorkOrderController\Show\Data;

use App\Http\Controllers\WorkOrderController\Show\Data\Kernel\DataLoaderContract;
use App\Models\WorkOrder;

class ReworksLoader implements DataLoaderContract
{
    public function data(WorkOrder $work_order): array
    {
        return [
            'template' => 'reworks',
            'reworks' => $work_order->reworks,
            'work_order' => $work_order,
        ];
    }
}
