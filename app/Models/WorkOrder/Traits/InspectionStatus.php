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


    // Actions

    public function updateInspectionStatus()
    {
        $wo = $this;

        self::withoutEvents(function() use ($wo) {
            $approved_count = $wo->inspections->filter(fn($i) => $i->isApproved())->count();      
            $this->inspection_status = $approved_count >= $wo->job->success_inspections_required_count ? 'inspected' : 'uninspected';
            $this->save();
        });
    }
}
