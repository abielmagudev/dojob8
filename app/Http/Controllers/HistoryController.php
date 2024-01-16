<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function __invoke(Request $request)
    {
        $history = History::with('user.profile')
        ->filterByInputs( $request->all() )
        ->orderBy('id', $request->get('sort', 'desc'))
        ->paginate(25)
        ->appends( $request->query() );
        
        return view('history.index', [
            'request' => $request,
            'topics' => History::getTopics(),
            'users' => User::with('profile')->withTrashed()->get(),
            'history' => $history,
        ]);
    }
}
