<?php

namespace App\Http\Controllers\AssessmentController\Index;

use Illuminate\Http\Request;

class RequestInitializer
{
    public static function init(Request $request)
    {
        if( empty( $request->except('page') ) )
        {
            $request->merge([
                'scheduled_date' => now()->format('Y-m-d'),
            ]);
        }

        return $request;
    }
}
