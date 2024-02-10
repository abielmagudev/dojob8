<?php

namespace App\Models\WorkOrder\Traits;

trait InspectionStatus
{
    protected $inspection_statuses = [
        'inspected',
        'uninspected',
        'non-inspectable',
    ];

    protected $statuses_for_inspection_status = [
        'completed',
    ];
}
