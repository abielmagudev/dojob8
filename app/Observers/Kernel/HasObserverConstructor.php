<?php

namespace App\Observers\Kernel;

use Illuminate\Http\Request;

trait HasObserverConstructor
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
