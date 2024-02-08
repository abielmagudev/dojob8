<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Middleware\SameOriginMiddleware;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientAjaxController extends Controller
{
    public function __construct()
    {
        // $this->middleware(SameOriginMiddleware::class)->only('search');
    }

    public function __invoke(Request $request)
    {
        return response()->json([
            'status' => 200, 
            'search' => $request->search,
            'clients' => $request->filled('search') ? Client::search($request->search)->limit(7)->get() : [],
        ]);
    }
}
