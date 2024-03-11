<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CrewMemberAssignmentController\CrewMemberAssigner;
use App\Http\Controllers\CrewMemberAssignmentController\CrewMemberAssignerMessenger;
use App\Http\Controllers\CrewMemberAssignmentController\ScheduledFetcherContainer;
use App\Http\Requests\CrewMemberAssignmentUpdateRequest;

class CrewMemberAssignmentController extends Controller
{
    public function __invoke(CrewMemberAssignmentUpdateRequest $request)
    {
        $redirect = redirect()->route('crews.index', ['template' => $request->template]);

        $fetcher = ScheduledFetcherContainer::get($request->assignment);

        $models = $fetcher::get($request->scheduled_date);

        if( $models->isEmpty() ) {
            return $redirect->with('warning', sprintf('Without %s to assign crew members at %s', $request->assignment, $request->scheduled_date));
        }

        $updated = CrewMemberAssigner::update($models, $request->filled('keep_crew_members_saved'));

        $message = CrewMemberAssignerMessenger::make($updated, $request);

        return $redirect->with($message->status, $message->content);
    }
}
