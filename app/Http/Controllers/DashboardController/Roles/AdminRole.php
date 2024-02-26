<?php 

namespace App\Http\Controllers\DashboardController\Roles;

use App\Http\Controllers\DashboardController\Roles\AdminRole\StatisticalDataGenerator;
use App\Http\Controllers\Kernel\ScheduleRange;
use Illuminate\Http\Request;

class AdminRole
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
