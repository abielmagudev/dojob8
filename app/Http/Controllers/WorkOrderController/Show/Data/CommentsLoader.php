<?php

namespace App\Http\Controllers\WorkOrderController\Show\Data;

use App\Http\Controllers\WorkOrderController\Show\Data\Kernel\DataLoaderContract;
use App\Models\WorkOrder;

class CommentsLoader implements DataLoaderContract
{
    public function data(WorkOrder $work_order): array
    {
        $work_order->load(['comments.user.profile']);

        return [
            'template' => 'comments',
            'comments' => $work_order->comments->sortByDesc('id'),
            'work_order' => $work_order,
        ];
    }
}
