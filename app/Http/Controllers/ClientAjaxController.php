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
        $clients = collect([]);

        if( $request->filled('search') ) {
            $clients = Client::search($request->search)->get();
        }

        return response()->json([
            'status' => 200, 
            'search' => $request->search,
            'total' => $clients->count(),
            'clients' => $clients->take(15),
        ]);
    }
}
