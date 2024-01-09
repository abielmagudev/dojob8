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

        $inspections = Inspection::withRelationsForIndex()
        ->filterByInputs( $request->all() )
        ->orderByRaw("scheduled_date IS NULL DESC, scheduled_date {$request->get('sort', 'DESC')}")
        ->orderBy('inspector_id', 'ASC')
        ->paginate(25)
        ->appends( $request->all() );

        return view('inspections.index', [
            'all_statuses' => Inspection::getAllStatuses(),
            'crews' => Crew::forInspections()->active()->get(),
            'inspections' => $inspections,
            'inspectors' => Inspector::all(),
            'scheduled_date' => $request->get('scheduled_date', now()->toDateString()),
            'request' => $request,
            'pending_inspections' => [
                'count' => Inspection::whereStatus('pending')->get()->count(),
                'url' => route('inspections.index', ['status' => 'pending', 'sort' => 'asc']),
            ],
            'on_hold_inspections' => [
                'count' => Inspection::whereStatus('on hold')->get()->count(),
                'url' => route('inspections.index', ['status' => 'on hold', 'sort' => 'asc']),
            ],
        ]);
    }

    public function create(WorkOrder $work_order)
    {
        return view('inspections.create', [
            'crews' => Crew::forInspections()->active()->get(),
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
        return view('inspections.show', [
            'inspection' => $inspection,
        ]);
    }

    public function edit(Request $request, Inspection $inspection)
    {
        return view('inspections.edit', [
            'crews' => Crew::forInspections()->active()->get(),
            'inspection' => $inspection,
            'inspectors' => Inspector::all(),
            'form_statuses' => Inspection::getFormStatuses(),
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
