<?php

namespace App\Models\WorkOrder\Traits;

use App\Models\Inspection;

trait Actions
{
    public function attachWorkers()
    {
        $this->members()->attach( 
            $this->crew->members->pluck('id')
        );
    }
}
