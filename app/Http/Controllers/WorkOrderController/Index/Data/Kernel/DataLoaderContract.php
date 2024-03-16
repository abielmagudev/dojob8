<?php

namespace App\Http\Controllers\WorkOrderController\Index\Data\Kernel;

use Illuminate\Http\Request;

interface DataLoaderContract
{
    public function data(Request $request): array;
}
