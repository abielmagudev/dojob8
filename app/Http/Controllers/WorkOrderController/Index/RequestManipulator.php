<?php

namespace App\Http\Controllers\WorkOrderController\Index;

use Carbon\Carbon;
use Illuminate\Http\Request;

class RequestManipulator
{
    public static function manipulate(Request $request)
    {
        $request = self::initial($request);
        $request = self::authenticated($request);
        return $request;
    }

    public static function initial(Request $request)
    {
        if( empty($request->except('page')) )
        {
            $request->merge([
                'scheduled_date' => Carbon::today()->format('Y-m-d'),
            ]);
        }

        return $request;
    }

    public static function authenticated(Request $request)
    {
        if( auth()->user()->hasFieldRole() )
        {
            if( auth()->user()->role_name == 'worker' ) {
                unset($request['pending']); // $request->request->remove('pending')
            }
        }

        if( auth()->user()->hasPartnerRole() )
        {
            $request->merge([
                'contractor' => null,
                'crew' => null,
                'job' => null,
                'pending' => null,
            ]);
        }

        return $request;
    }
}
