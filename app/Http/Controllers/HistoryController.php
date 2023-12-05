<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('history.index', [
            'request' => $request,
            'topics' => History::getTopics(),
            'users' => User::with('profile')->withTrashed()->get(),
            'history' => History::with('user.profile')
                                ->filtersByRequest($request)
                                ->orderBy('id', $request->get('sort', 'desc'))
                                ->paginate(25)
                                ->appends( $request->query() ),
        ]);
    }
}
