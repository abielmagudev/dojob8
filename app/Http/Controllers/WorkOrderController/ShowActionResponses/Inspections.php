<?php

namespace App\Http\Controllers\WorkOrderController\ShowActionResponses;

use App\Http\Controllers\WorkOrderController\ShowActionResponses\Kernel\ShowActionResponseBase;
use App\Http\Controllers\WorkOrderController\ShowActionResponses\Kernel\ShowActionResponseInterface;

class Inspections extends ShowActionResponseBase implements ShowActionResponseInterface
{
    public function data(array $default): array
    {
        return array_merge([
            'tab' => 'inspections',
        ], $default);
    }
}
