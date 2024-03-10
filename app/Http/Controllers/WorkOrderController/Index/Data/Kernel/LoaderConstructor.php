<?php

namespace App\Http\Controllers\WorkOrderController\Index\Data\Kernel;

use Illuminate\Http\Request;

class LoaderConstructor
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
