<?php

namespace App\Http\Controllers\WorkOrderController\Show;

use App\Http\Controllers\WorkOrderController\Kernel\ResponseConstructor;
use App\Models\Media\Kernel\FileRestriction;

class Media extends ResponseConstructor
{
    public function forData(): array
    {
        return [
            'show' => 'media',
            'accepts' => FileRestriction::accepts(),
        ];
    }
}
