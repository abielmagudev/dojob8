<?php

namespace App\Http\Controllers\WorkOrderController\Show\Data;

use App\Http\Controllers\WorkOrderController\Show\Data\Kernel\DataLoaderContract;
use App\Models\Media\Kernel\MediaRestriction;
use App\Models\WorkOrder;

class MediaLoader implements DataLoaderContract
{
    public function data(WorkOrder $work_order): array
    {
        return [
            'template' => 'media',
            'accepts' => MediaRestriction::accepts(),
            'media' => $work_order->media,
            'work_order' => $work_order,
        ];
    }
}
