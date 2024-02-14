<?php

namespace App\Http\Controllers;

use App\Http\Requests\InspectionStatusUpdateRequest;
use App\Models\Inspection;
use Illuminate\Http\Request;

class InspectionStatusController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(InspectionStatusUpdateRequest $request)
    {
        $result = Inspection::whereIn('id', $request->get('inspections'))->noPendingStatus()->update(['status' => $request->get('status')]);

        $status_uppercase = strtoupper($request->get('status'));

        if( $result === false ) {
            return redirect($request->url_back)->with('danger', "Error updating inspection status <b>{$status_uppercase}</b>, try again...");
        }

        $comparison_updated = sprintf('%s/%s', count($request->get('inspections')), $result);

        return redirect($request->url_back)->with('success', "{$comparison_updated} Inspections were updated with status <b>{$status_uppercase}</b>");
    }
}
