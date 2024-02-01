<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrewMemberUpdateRequest;
use App\Models\Crew;

class CrewMemberController extends Controller
{
    public function __invoke(CrewMemberUpdateRequest $request)
    {
        $crew = Crew::find($request->get('crew'));

        $crew->members()->sync($request->get('members', []));

        if( $request->header('X-Requested-With') == 'XMLHttpRequest' || $request->ajax() || $request->wantsJson() || $request->expectsJson() )
        {
            return response()->json([
                'status' => 200,
                'message' => "You updated <b>{$crew->name}</b> crew members",
            ]);
        }
        
        return back()->with('success', "You updated <b>{$crew->name}</b> crew members");
    }
}
