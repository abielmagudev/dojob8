<?php

namespace App\Http\Controllers\CrewMemberAssignmentController;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CrewMemberAssignerMessenger
{
    public static function make(Collection $updated, Request $request)
    {
        $failed = $updated->filter(fn($up) => $up === false);

        if( $failed->isNotEmpty() ) {
            return (object) [
                'status' => 'danger',
                'content' => sprintf(
                    'Error updating crew members of %s <b>%s</b> with schedule date <b>%s</b>, try again please...', 
                    $request->assignment, 
                    $failed->keys()->implode(','),
                    $request->scheduled_date
                ),
            ];
        }

        return (object) [
            'status' => 'success',
            'content' => sprintf(
                'Crew members of %s <b>%s</b> with schedule date <b>%s</b> updated',
                $request->assignment, 
                $updated->keys()->implode(','),
                $request->scheduled_date              
            ),
        ];
    }
}
