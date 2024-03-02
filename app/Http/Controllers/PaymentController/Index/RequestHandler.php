<?php

namespace App\Http\Controllers\PaymentController\Index;

use App\Models\Payment;
use Illuminate\Http\Request;

class RequestHandler
{
    public static function handle(Request $request)
    {
        if( empty($request->all()) )
        {
            $request->merge([
                'dates' => 'any',
                'status_group' => [Payment::INITIAL_STATUS],
            ]);
        }

        return $request;
    }
}
