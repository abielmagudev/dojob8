<?php 

namespace App\Http\Controllers\DashboardController;

use App\Http\Controllers\DashboardController\AdminDashboard\StatisticalDataGenerator;
use App\Http\Controllers\Kernel\ScheduleRange;
use Illuminate\Http\Request;

class AdminDashboard
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
