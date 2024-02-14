<?php

namespace App\Http\Controllers;

use App\Http\Controllers\InspectionController\InspectionUrlGenerator;
use App\Http\Requests\InspectionSaveRequest;
use App\Models\Agency;
use App\Models\Crew;
use App\Models\Inspection;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    public function index(Request $request)
    {
        if( empty($request->all()) )
        {
            $request->merge([
                'scheduled_date' => now()->toDateString(),
            ]);
        }

        $inspections = Inspection::withRelationshipsForIndex()
        ->filterByParameters( $request->all() )
        ->orderByRaw("scheduled_date IS NULL, scheduled_date {$request->get('sort', 'DESC')}")
        ->orderBy('agency_id', 'ASC')
        ->paginate(35)
        ->appends( $request->all() );

        return view('inspections.index', [
            'all_statuses_form' => Inspection::allStatusesForm(),
            'agencies' => Agency::all(),
            'inspections' => $inspections,
            'scheduled_date' => $request->get('scheduled_date', now()->toDateString()),
            'request' => $request,
            'pending_inspections' => [
                'count' => Inspection::where('status', 'pending')->get()->count(),
                'url' => InspectionUrlGenerator::pending(),
            ],
            'awaiting_inspections' => [
                'count' => Inspection::where('status', 'awaiting')->get()->count(),
                'url' => InspectionUrlGenerator::awaiting(),
            ],
        ]);
    }

    public function create(WorkOrder $work_order)
    {
        return view('inspections.create', [
            'agencies' => Agency::all(),
            'all_statuses_form' => Inspection::allStatusesForm(),
            'crews' => Crew::taskInspections()->active()->get(),
            'inspection' => new Inspection,
            'inspector_names' => Inspection::onlyInspectorNames(),
            'work_order' => $work_order,
            'url_back' => route('work-orders.show', [$work_order, 'tab' => 'inspections']),
        ]);
    }

    public function store(InspectionSaveRequest $request)
    {
        if(! $inspection = Inspection::create( $request->validated() ) ) {
            return back()->with('danger', 'Error creating inspection, try again please');
        }

        return redirect()->route('work-orders.show', [$inspection->work_order_id, 'tab' => 'inspections'])->with('success', "You created inspection <b>{$inspection->id}</b>");
    }

    public function show(Inspection $inspection)
    {
        return view('inspections.show')->with('inspection', $inspection);
    }

    public function edit(Request $request, Inspection $inspection)
    {
        $url_back = $request->filled('url_back') ? $request->get('url_back') : route('work-orders.show', [$inspection->work_order_id, 'tab' => 'inspections']);

        return view('inspections.edit', [
            'agencies' => Agency::all(),
            'all_statuses_form' => Inspection::allStatusesForm(),
            'crews' => Crew::taskInspections()->active()->get(),
            'inspection' => $inspection,
            'inspector_names' => Inspection::onlyInspectorNames(),
            'url_back' => $url_back,
        ]);
    }

    public function update(InspectionSaveRequest $request, Inspection $inspection)
    {
        if(! $inspection->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating inspection, try again please');
        }

        if( $inspection->work_order->job->requiresApprovedInspections() ) {
            $inspection->work_order->updateInspectionStatus();
        }

        return redirect()->route('inspections.edit', $inspection)->with('success', "You updated inspection <b>{$inspection->id}</b>");
    }

    public function destroy(Inspection $inspection)
    {
        if(! $inspection->delete() ) {
            return back()->with('danger', 'Error deleting inspection, try again please');
        }

        return redirect()->route('work-orders.show', $inspection->work_order_id)->with('success', "You deleted inspection <b>{$inspection->id}</b>");
    }
}
