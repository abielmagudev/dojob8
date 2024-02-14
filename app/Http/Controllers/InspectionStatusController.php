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

        $message = $result === false
                 ? ['warning', 'Error updating inspection status, try again...']
                 : ['success', 'The status of the selected inspections was updated.'];

        return redirect($request->url_back)->with($message[0], $message[1]);
    }
}
