<?php

namespace App\Http\Controllers\CrewMemberAssignmentController;

use App\Models\Crew;
use App\Models\WorkOrder;

class ScheduledWorkOrderFetcher
{
    public static function get(string $scheduled_date)
    {
        return WorkOrder::with('crew.members')
        ->incomplete()
        ->whereIn('crew_id', Crew::active()->pluck('id')->toArray())
        ->where('scheduled_date', $scheduled_date)
        ->get();
    }
}
