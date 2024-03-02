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
    public function __construct()
    {
        $this->authorizeResource(Inspection::class, 'inspection');
    }

    public function index(Request $request)
    {
        if( empty($request->all()) )
        {
            $request->merge([
                'scheduled_date' => now()->toDateString(),
            ]);
        }

        $inspections = Inspection::withEssentialRelationships()
        ->withNestedRelationships()
        ->filterByParameters( $request->all() )
        ->orderByRaw("scheduled_date IS NULL, scheduled_date {$request->get('sort', 'DESC')}")
        ->orderBy('agency_id', 'ASC')
        ->paginate(35)
        ->appends( $request->all() );

        return view('inspections.index', [
            'all_statuses' => Inspection::collectionAllStatuses(),
            'agencies' => Agency::all(),
            'inspections' => $inspections,
            'scheduled_date' => $request->get('scheduled_date', now()->toDateString()),
            'request' => $request,
            'pending_inspections' => [
                'count' => Inspection::pendingAttributesCount()->first()->pending_attributes_count,
                'url' => InspectionUrlGenerator::pending(),
            ],
            'awaiting_inspections' => [
                'count' => Inspection::awaitingStatusCount()->noPendingAttributes()->first()->awaiting_status_count,
                'url' => InspectionUrlGenerator::awaiting(),
            ],
        ]);
    }

    public function create(WorkOrder $work_order)
    {
        return view('inspections.create', [
            'agencies' => Agency::all(),
            'all_statuses' => Inspection::collectionAllStatuses(),
            'crews' => Crew::taskInspections()->active()->get(),
            'inspection' => new Inspection,
            'inspector_names' => Inspection::inspectorNames()->get(),
            'work_order' => $work_order,
            'url_back' => route('work-orders.show', [$work_order, 'tab' => 'inspections']),
        ]);
    }

    public function store(InspectionSaveRequest $request)
    {
        if(! $inspection = Inspection::create( $request->validated() ) ) {
            return back()->with('danger', 'Error creating inspection, try again please');
        }

        if( $inspection->hasCrew() && $inspection->crew->hasMembers() )
        {
            $inspection->members()->attach( 
                $inspection->crew->members->pluck('id')->toArray()
            );
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
            'all_statuses' => Inspection::collectionAllStatuses(),
            'crews' => Crew::taskInspections()->active()->get(),
            'inspection' => $inspection,
            'inspector_names' => Inspection::inspectorNames()->get()->pluck('inspector_name'),
            'url_back' => $url_back,
        ]);
    }

    public function update(InspectionSaveRequest $request, Inspection $inspection)
    {
        $old_crew_id = $inspection->crew_id;

        if(! $inspection->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating inspection, try again please');
        }

        if( $inspection->work_order->job->requiresSuccessInspections() ) {
            $inspection->work_order->updateInspectionStatus();
        }

        if( $old_crew_id <> $inspection->crew_id && $inspection->hasCrew() && $inspection->crew->hasMembers() )
        {
            $inspection->members()->sync( 
                $inspection->crew->members->pluck('id')->toArray()
            );
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
