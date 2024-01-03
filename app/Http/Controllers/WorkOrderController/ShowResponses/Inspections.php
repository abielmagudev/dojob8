<?php

namespace App\Http\Controllers\WorkOrderController\ShowResponses;

use App\Http\Controllers\WorkOrderController\ShowResponses\Kernel\ShowResponseBase;
use App\Models\Inspection;

class Inspections extends ShowResponseBase
{
    public function forData(): array
    {
        return [
            'show' => 'inspections',
            'inspections' => Inspection::with(['inspector','crew'])->where('work_order_id', $this->work_order->id)->get(),
        ];
    }
}
