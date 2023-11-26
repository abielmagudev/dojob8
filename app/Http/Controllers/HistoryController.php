<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->merge([
            'sort' => in_array($request->get('sort'), ['asc', 'desc']) ? $request->get('sort') : 'desc',
        ]);

        return view('history.index', [
            'request' => $request,
            'topics' => History::getTopics(),
            'users' => User::all(),
            'history' => History::with('user')
                                ->filters($request)
                                ->orderBy('id', $request->get('sort'))
                                ->paginate(25)
                                ->appends( $request->query() ),
        ]);
    }
}
