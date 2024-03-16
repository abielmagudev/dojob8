<?php

namespace App\Http\Controllers\WorkOrderController\Show\Data;

use App\Http\Controllers\WorkOrderController\Show\Data\Kernel\DataLoaderContract;
use App\Models\History;
use App\Models\WorkOrder;

class HistoryLoader implements DataLoaderContract 
{
    public function data(WorkOrder $work_order): array
    {
        return [
            'template' => 'history',
            'history' => $work_order->history()->with('user')->paginate(35),
            'work_order' => $work_order,
        ];
    }
}
