<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DashboardController\StatisticalDataGenerator;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
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

        return view('dashboard.index', array_merge(
            $generator->dataByDefault(),
            $generator->dataByRequest(),
            ['request' => $request]
        ));
    }
}
