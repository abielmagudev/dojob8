<?php

namespace App\Http\Controllers\Kernel;

use Illuminate\Http\Request;

class ScheduleRange
{
    public static function setFromToRequest(Request $request)
    {
        if(! $request->filled('from') )
        {
            $request->merge([
                'from' => date('Y-01-01'),
            ]);
        }

        if(! $request->has('to') )
        {
            $request->merge([
                'to' => date('Y-m-d'),
            ]);
        }

        return $request;
    }
}
