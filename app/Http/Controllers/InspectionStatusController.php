<?php

namespace App\Http\Controllers;

use App\Http\Requests\InspectionStatusUpdateRequest;
use App\Models\History;
use App\Models\Inspection;
use Illuminate\Http\Request;

class InspectionStatusController extends Controller
{
    public function __invoke(InspectionStatusUpdateRequest $request)
    {
        $result = Inspection::whereIn('id', $request->get('inspections'))
        ->noPendingAttributes()
        ->update([
            'status' => $request->get('status')
        ]);

        $status_uppercase = strtoupper($request->get('status'));

        if( $result === false ) {
            return redirect($request->url_back)->with('danger', "Error updating inspection status <b>{$status_uppercase}</b>, try again...");
        }

        $this->history($request);

        $comparison_updated = sprintf('%s/%s', count($request->get('inspections')), $result);

        return redirect($request->url_back)->with('success', "{$comparison_updated} Inspections were updated with status <b>{$status_uppercase}</b>");
    }

    private function history(Request $request)
    {
        $inspections = Inspection::whereIn('id', $request->get('inspections'))->noPendingAttributes()->get();

        $data = $inspections->map(function($i) use ($request) {
            return [
                'description' => sprintf('Updated work order %s inspection %s status to <b>%s</b>', $i->work_order_id, $i->id, $request->get('status')),
                'link' => route('work-orders.show', [$i->work_order_id, 'tab' => 'inspections']),
                'model_type' => Inspection::class,
                'model_id' => $i->id,
                'user_id' => auth()->id(),
            ];
        })->toArray();

        return History::insert($data);
    }
}
