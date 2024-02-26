<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrewMemberUpdateRequest;
use App\Models\Crew;
use Illuminate\Http\Request;

class CrewMemberController extends Controller
{
    public function __invoke(CrewMemberUpdateRequest $request)
    {
        $crew = Crew::find($request->get('crew'));

        $result = $this->syncCrewMembers($request, $crew);
        
        return isRequestAjax($request) ? $this->responseAjax($crew, $result) : $this->responseHttp($crew, $result);
    }

    protected function syncCrewMembers(Request $request, Crew $crew)
    {
        return (bool) $crew->members()->sync(
            $request->get('members', [])
        );
    }

    protected function responseAjax(Crew $crew, bool $result)
    {
        return response()->json([
            'message' => "You updated <b>{$crew->name}</b> crew members",
            'status' => 200,
        ]);
    }

    protected function responseHttp(Crew $crew, bool $result)
    {
        return back()->with('success', "You updated <b>{$crew->name}</b> crew members");
    }
}
