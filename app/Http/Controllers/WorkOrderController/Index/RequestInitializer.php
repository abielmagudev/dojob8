<?php 

namespace App\Http\Controllers\WorkOrderController\Index;

use Carbon\Carbon;
use Illuminate\Http\Request;

class RequestInitializer
{
    public static function make(Request $request)
    {
        if( empty($request->except('page')) )
        {
            $request->merge([
                'scheduled_date' => Carbon::today()->format('Y-m-d'),
            ]);
        }

        return $request;
    }
}
