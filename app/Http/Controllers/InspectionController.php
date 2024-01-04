<?php

namespace App\Http\Controllers;

use App\Http\Requests\InspectionStoreRequest;
use App\Http\Requests\InspectionUpdateRequest;
use App\Models\Crew;
use App\Models\Inspection;
use App\Models\Inspector;
use App\Models\WorkOrder;
use Carbon\Carbon;
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

        $inspections = Inspection::with([
            'crew',
            'inspector', 
            'work_order.job', 
            'work_order.client'
        ])
        ->filtersByRequest($request)
        ->orderByRaw("scheduled_date IS NULL DESC, scheduled_date {$request->get('sort', 'desc')}, inspector_id ASC")
        // ->orderBy('inspector_id', 'desc')
        // ->orderBy('scheduled_date', $request->get('sort', 'desc'))
        ->paginate(25)
        ->appends( $request->all() );

        $scheduled_casted = $request->has('scheduled_date_range') ? [
            Carbon::parse( $request->input('scheduled_date_range.0') ),
            Carbon::parse( $request->input('scheduled_date_range.1') ),
        ] : Carbon::parse( $request->get('scheduled_date') );

        return view('inspections.index', [
            'request' => $request,
            'inspections' => $inspections,
            'inspectors' => Inspector::all(),
            'crews' => (Crew::active()->get())->filter(fn($crew) => $crew->hasTypeTask('inspections')),
            'statuses_values' => Inspection::getStatusesValues(),
            'scheduled_casted' => $scheduled_casted,
            'scheduled_date' => $request->get('scheduled_date', now()->toDateString()),
            'pending_inspections' => [
                'count' => Inspection::pendings()->count(),
                'url' => Inspection::generatePendingInspectionsUrl(),
            ],
        ]);
    }

    public function create(WorkOrder $work_order)
    {
        return view('inspections.create', [
            'crews' => Crew::active()->orderBy('name')->get(),
            'inspection' => new Inspection,
            'inspectors' => Inspector::all(),
            'work_order' => $work_order,
        ]);
    }

    public function store(InspectionStoreRequest $request)
    {
        if(! $inspection = Inspection::create( $request->validated() ) ) {
            return back()->with('danger', 'Error saving inspection, try again please');
        }

        return redirect()->route('work-orders.show', [$inspection->work_order_id, 'tab' => 'inspections'])->with('success', "You saved inspection <b>{$inspection->id}</b>");
    }

    public function show(Inspection $inspection)
    {
        $previous = $inspection->before();
        $next = $inspection->after();

        return view('inspections.show', [
            'inspection' => $inspection,
            'routes' => [
                'previous' => $previous ? route('inspections.show', $previous) : false,
                'next' => $next ? route('inspections.show', $next) : false,
            ],
        ]);
    }

    public function edit(Request $request, Inspection $inspection)
    {
        return view('inspections.edit', [
            'crews' => Crew::active()->orderBy('name')->get(),
            'inspection' => $inspection,
            'inspectors' => Inspector::all(),
            'statuses_values' => Inspection::getStatusesValues(),
            'url_back' => $request->filled('tab') ? route('work-orders.show', [$inspection->work_order_id, 'tab' => 'inspections']) : route('inspections.show', $inspection),
        ]);
    }

    public function update(InspectionUpdateRequest $request, Inspection $inspection)
    {
        if(! $inspection->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating inspection, try again please');
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
