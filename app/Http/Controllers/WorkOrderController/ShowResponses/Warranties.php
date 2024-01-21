<?php

namespace App\Http\Controllers\WorkOrderController\ShowResponses;

use App\Http\Controllers\WorkOrderController\ShowResponses\Kernel\ShowResponseBase;

class Warranties extends ShowResponseBase
{
    public function forData(): array
    {
        return [
            'show' => $this->work_order->isDefault() ? 'warranties' : 'summary',
        ];
    }
}
