<?php

namespace App\Http\Controllers\WorkOrderController\ShowResponses;

use App\Http\Controllers\WorkOrderController\ShowResponses\Kernel\ShowResponseBase;

class Media extends ShowResponseBase
{
    public function forData(): array
    {
        return [
            'show' => 'media',
        ];
    }
}
