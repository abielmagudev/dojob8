<?php 

namespace App\Http\Controllers\DashboardController\Responses;

use App\Http\Controllers\DashboardController\Responses\AdminResponse\StatisticalDataGenerator;
use App\Http\Controllers\Kernel\ScheduleRange;
use Illuminate\Http\Request;

class AdminResponse
{
    public static function response(Request $request)
    {
        $request = ScheduleRange::setFromToRequest($request);

        $generator = new StatisticalDataGenerator($request);

        return view('dashboard.admin.index', array_merge(
            $generator->dataByDefault(),
            $generator->dataByRequest(),
            ['request' => $request]
        ));
    }
}
