<?php 

namespace App\Http\Controllers\DashboardController\Responses;

use App\Http\Controllers\DashboardController\Responses\AdminResponse\StatisticalDataGenerator;
use App\Http\Controllers\Kernel\ScheduleRange;
use Illuminate\Http\Request;

class AdminResponse
{
    public static function response(Request $request)
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
        
        $generator = new StatisticalDataGenerator($request);

        return view('dashboard.admin.index', array_merge(
            $generator->dataByDefault(),
            $generator->dataByRequest(),
            ['request' => $request]
        ));
    }
}
