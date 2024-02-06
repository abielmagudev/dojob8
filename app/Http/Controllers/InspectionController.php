<?php

namespace App\Http\Controllers;

use App\Http\Requests\InspectionStoreRequest;
use App\Http\Requests\InspectionUpdateRequest;
use App\Models\Agency;
use App\Models\Crew;
use App\Models\Inspection;
use App\Models\Inspection\InspectionUrlGenerator;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    public function index(Request $request)
    {
        if( count($request->all()) == 0 ) {
            $request->merge([
                'scheduled_date' => now()->toDateString(),
            ]);
        }

        $inspections = Inspection::withRelationshipsForIndex()
        ->filterByInputs( $request->all() )
        ->orderByRaw("scheduled_date IS NULL DESC, scheduled_date {$request->get('sort', 'DESC')}")
        ->orderBy('agency_id', 'ASC')
        ->paginate(25)
        ->appends( $request->all() );

        return view('inspections.index', [
            'agencies' => Agency::all(),
            'inspections' => $inspections,
            'scheduled_date' => $request->get('scheduled_date', now()->toDateString()),
            'request' => $request,
            'pending_inspections' => [
                'count' => Inspection::where('status', 'pending')->get()->count(),
                'url' => InspectionUrlGenerator::pending(),
            ],
            'on_hold_inspections' => [
                'count' => Inspection::where('status', 'on hold')->get()->count(),
                'url' => InspectionUrlGenerator::onHold(),
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
        ]);
    }

    public function store(InspectionStoreRequest $request)
    {
        if(! $inspection = Inspection::create( $request->validated() ) ) {
            return back()->with('danger', 'Error creating inspection, try again please');
        }

        return redirect()->route('work-orders.show', [$inspection->work_order_id, 'tab' => 'inspections'])->with('success', "You created inspection <b>{$inspection->id}</b>");
    }

    public function show(Inspection $inspection)
    {
        return view('inspections.show', [
            'inspection' => $inspection,
        ]);
    }

    public function edit(Request $request, Inspection $inspection)
    {
        return view('inspections.edit', [
            'agencies' => Agency::all(),
            'all_statuses_form' => Inspection::allStatusesForm(),
            'crews' => Crew::taskInspections()->active()->get(),
            'inspection' => $inspection,
            'inspector_names' => Inspection::onlyInspectorNames(),
            'url_back' => $request->get('url_back', route('work-orders.show', [$inspection->work_order_id, 'tab' => 'inspections'])),
        ]);
    }

    public function update(InspectionUpdateRequest $request, Inspection $inspection)
    {
        if(! $inspection->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating inspection, try again please');
        }

        if( $inspection->isPassed() ) {
            $inspection->work_order->changesToInspectedStatus();
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
