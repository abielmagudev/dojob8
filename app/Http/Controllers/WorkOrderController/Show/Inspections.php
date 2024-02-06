<?php

namespace App\Http\Controllers\WorkOrderController\Show;

use App\Http\Controllers\WorkOrderController\Kernel\ResponseConstructor;
use App\Models\Inspection;

class Inspections extends ResponseConstructor
{
    public function forData(): array
    {
        return [
            'show' => 'inspections',
            'inspections' => Inspection::with(['agency','crew'])->where('work_order_id', $this->work_order->id)->get(),
        ];
    }
}
