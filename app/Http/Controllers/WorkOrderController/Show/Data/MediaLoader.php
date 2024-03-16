<?php

namespace App\Http\Controllers\WorkOrderController\Show\Data;

use App\Http\Controllers\WorkOrderController\Show\Data\Kernel\DataLoaderContract;
use App\Models\Media\Kernel\FileRestriction;
use App\Models\WorkOrder;

class MediaLoader implements DataLoaderContract
{
    public function data(WorkOrder $work_order): array
    {
        return [
            'template' => 'media',
            'accepts' => FileRestriction::accepts(),
            'media' => $work_order->media,
            'work_order' => $work_order,
        ];
    }
}
