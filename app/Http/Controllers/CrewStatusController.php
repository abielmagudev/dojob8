<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrewStatusUpdateRequest;
use App\Models\Crew;
use App\Models\CrewMember;

class CrewStatusController extends Controller
{
    public function __invoke(CrewStatusUpdateRequest $request)
    {
        $result['inactive'] = Crew::whereNotIn('id', $request->get('crews', []))->updateInactive();

        $result['active'] = Crew::whereIn('id', $request->get('crews', []))->updateActive();

        if( $result['inactive'] === false || $result['active'] === false ) {
            return back()->with('danger', 'Error activating or deactivating crews, try again please');
        }

        if( $result['inactive'] === 0 ) {
            return redirect()->route('crews.index')->with('success', 'You activated crews');
        }   

        CrewMember::removeCrews( $request->get('crews', []) );

        if( $result['active'] === 0 ) {
            return redirect()->route('crews.index')->with('success', 'You deactivated crews');
        }

        return redirect()->route('crews.index')->with('success', 'You updated the active and inactive status of crews');
    }
}
