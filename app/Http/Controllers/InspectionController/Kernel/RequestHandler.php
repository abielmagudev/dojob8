<?php

namespace App\Http\Controllers\InspectionController\Kernel;

use Illuminate\Http\Request;

class RequestHandler
{
    public static function index(Request $request)
    {
        if( empty($request->all()) )
        {
            $request->merge([
                'scheduled_date' => now()->toDateString(),
            ]);
        }

        return $request;
    }
}
