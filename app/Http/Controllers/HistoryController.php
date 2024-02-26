<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->authorize('viewAny', History::class);

        $history = History::with('user.profile')
        ->filterByParameters( $request->all() )
        ->orderBy('id', $request->get('sort', 'desc'))
        ->paginate(35)
        ->appends( $request->query() );
        
        return view('history.index', [
            'history' => $history,
            'request' => $request,
            'topics' => History::getTopics(),
            'users' => User::withTrashed()->get(),
        ]);
    }
}
