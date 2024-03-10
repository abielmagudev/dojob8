<?php

namespace App\Http\Controllers;

use App\Http\Controllers\InspectionController\InspectionUrlGenerator;
use App\Http\Controllers\InspectionController\Kernel\RequestHandler;
use App\Http\Requests\InspectionStoreRequest;
use App\Http\Requests\InspectionUpdateRequest;
use App\Models\Agency;
use App\Models\Crew;
use App\Models\Inspection;
use App\Models\Inspection\Kernel\InspectionStatusCatalog;
use App\Models\Inspection\Services\InspectionCrewMemberService;
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
        $request = RequestHandler::index($request);

        $inspections = Inspection::withEssentialRelationships()
        ->withNestedRelationships()
        ->filterByParameters( $request->all() )
        ->orderByRaw("scheduled_date IS NULL, scheduled_date {$request->get('sort', 'DESC')}")
        ->orderBy('agency_id', 'DESC')
        ->paginate(35)
        ->appends( $request->all() );

        return view('inspections.index', [
            'all_statuses' => InspectionStatusCatalog::all(),
            'agencies' => Agency::all(),
            'crews' => Crew::purposeInspections()->active()->get(),
            'inspections' => $inspections,
            'scheduled_date' => $request->get('scheduled_date', now()->toDateString()),
            'request' => $request,
            'pending_inspections' => [
                'count' => Inspection::asPendingCount()->first()->pending_count,
                'url' => InspectionUrlGenerator::pending(),
            ],
            'awaiting_inspections' => [
                'count' => Inspection::awaitingStatusCount()->noPending()->first()->awaiting_status_count,
                'url' => InspectionUrlGenerator::awaiting(),
            ],
        ]);
    }

    public function create(WorkOrder $work_order)
    {
        return view('inspections.create', [
            'agencies' => Agency::all(),
            'all_statuses' => InspectionStatusCatalog::all(),
            'crews' => Crew::purposeInspections()->active()->get(),
            'inspection' => new Inspection,
            'inspector_names' => Inspection::inspectorNames()->get(),
            'work_order' => $work_order,
            'url_back' => route('work-orders.show', [$work_order, 'tab' => 'inspections']),
        ]);
    }

    public function store(InspectionStoreRequest $request)
    {
        if(! $inspection = Inspection::create( $request->validated() ) ) {
            return back()->with('danger', 'Error creating inspection, try again please');
        }

        (new InspectionCrewMemberService($inspection))->attach();

        return redirect()->route('work-orders.show', [$inspection->work_order_id, 'tab' => 'inspections'])->with('success', "You created inspection <b>{$inspection->id}</b>");
    }

    public function show(Inspection $inspection)
    {
        return redirect()->route('work-orders.show', [$inspection->work_order_id, 'tab' => 'inspections']);
    }

    public function edit(Request $request, Inspection $inspection)
    {
        $url_back = $request->filled('url_back') ? $request->get('url_back') : route('work-orders.show', [$inspection->work_order_id, 'tab' => 'inspections']);

        return view('inspections.edit', [
            'agencies' => Agency::all(),
            'all_statuses' => InspectionStatusCatalog::all(),
            'crews' => Crew::purposeInspections()->active()->get(),
            'inspection' => $inspection,
            'inspector_names' => Inspection::inspectorNames()->get()->pluck('inspector_name'),
            'url_back' => $url_back,
        ]);
    }

    public function update(InspectionUpdateRequest $request, Inspection $inspection)
    {
        if(! $inspection->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating inspection, try again please');
        }

        $service = new InspectionCrewMemberService($inspection);

        $service->detachWhenNoHasCrew();

        if( $request->get('replace_crew_members') == 1 ) {
            $service->detach()->attach();
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
