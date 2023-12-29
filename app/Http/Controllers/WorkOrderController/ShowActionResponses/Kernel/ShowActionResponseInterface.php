<?php 

namespace App\Http\Controllers\WorkOrderController\ShowActionResponses\Kernel;

interface ShowActionResponseInterface
{
    public function data(array $default): array;
}
