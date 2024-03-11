<?php

namespace App\Http\Controllers\CrewMemberAssignmentController;

use App\Models\Crew;
use App\Models\Inspection;

class ScheduledInspectionFetcher
{
    public static function get(string $scheduled_date)
    {
        return Inspection::with('crew.members')
        ->awaiting()
        ->whereIn('crew_id', Crew::active()->pluck('id')->toArray())
        ->where('scheduled_date', $scheduled_date)
        ->get();
    }
}
