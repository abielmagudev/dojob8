<?php

namespace App\Http\Controllers\WorkOrderController\Index;

use Carbon\Carbon;
use Illuminate\Http\Request;

class RequestManipulator
{
    public static function manipulate(Request $request)
    {
        if( empty($request->except('page')) ) {
            $request->merge([
                'scheduled_date' => Carbon::today()->format('Y-m-d'),
            ]);
        }

        return $request;
    }
}
