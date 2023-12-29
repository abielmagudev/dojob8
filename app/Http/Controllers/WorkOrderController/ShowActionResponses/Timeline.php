<?php

namespace App\Http\Controllers\WorkOrderController\ShowActionResponses;

use App\Http\Controllers\WorkOrderController\ShowActionResponses\Kernel\ShowActionResponseBase;
use App\Http\Controllers\WorkOrderController\ShowActionResponses\Kernel\ShowActionResponseInterface;

class Timeline extends ShowActionResponseBase implements ShowActionResponseInterface
{
    public function data(array $default): array
    {
        return array_merge([
            'tab' => 'timeline',
        ], $default);
    }
}
