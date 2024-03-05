<?php

namespace App\Models\Job\Services;

use App\Models\InspectionSetupForJob;
use App\Models\Job;
use Illuminate\Http\Request;

class InspectionSetupService
{
    public static function sync(Request $request, Job $job)
    {
        InspectionSetupForJob::where('job_id', $job->id)->delete();

        return self::create($request, $job);
    }

    public static function create(Request $request, Job $job)
    {
        $created = [];

        if( $request->filled('inpsections_setup') )
        {
            foreach($request->get('inpsections_setup') as $options)
            {
                $created[] = InspectionSetupForJob::create([
                    'options_json' => $options,
                    'job_id' => $job->id,
                ]);
            }    
        }

        return $created;
    }
}
