<?php

namespace App\Http\Controllers\CrewMemberAssignmentController;

class ScheduledFetcherContainer
{
    public static $fetchers = [
        'inspections' => ScheduledInspectionFetcher::class,
        'work orders' => ScheduledWorkOrderFetcher::class,
    ];
    
    public static function all()
    {
        return collect( self::$fetchers );
    }

    public static function keys()
    {
        return self::all()->keys();
    }

    public static function get(string $key)
    {
        return self::all()->get($key);
    }
}
