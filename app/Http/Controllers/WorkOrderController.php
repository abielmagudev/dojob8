<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Kernel\ReflashInputErrorsTrait;
use App\Http\Controllers\WorkOrderController\ShowAction;
use App\Http\Requests\WorkOrderStoreRequest;
use App\Http\Requests\WorkOrderUpdateRequest;
use App\Models\Client;
use App\Models\Contractor;
use App\Models\Crew;
use App\Models\Inspection;
use App\Models\Job;
use App\Models\WorkOrder;
use App\Models\WorkOrder\WorkOrderUrlGenerator;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class WorkOrderController extends Controller
{
    use ReflashInputErrorsTrait;

    public function index(Request $request)
    {
        if( empty($request->except('page')) ) {
            $request->merge([
                'scheduled_date' => Carbon::today()->format('Y-m-d'),
            ]);
        }

        $work_orders = WorkOrder::withBasicRelationships()
        ->filterByInputs( $request->all() )
        ->orderBy( 
            $request->has('fltr') ? 'scheduled_date' : 'crew_id', 
            $request->get('sort', 'desc')
        )
        ->paginate( $request->has('fltr') ? 25 : 250 )
        ->appends( $request->query() );

        return view('work-orders.index', [
            'all_statuses' => WorkOrder::getAllStatuses(),
            'all_types' => WorkOrder::getAllTypes(),
            'crews' => Crew::taskWorkOrders()->active()->orderBy('name', 'desc')->get(),
            'contractors' => Contractor::all(),
            'jobs' => Job::all(),
            'request' => $request,
            'incomplete_work_orders' => [
                'url' => WorkOrderUrlGenerator::incomplete(),
                'count' => WorkOrder::incompleteStatuses()->count(),
            ],
            'work_orders' => $work_orders,
        ]);
    }

    public function create(Request $request, Client $client)
    {
        $this->reflashInputErrors();

        return view('work-orders.create', [
            'all_statuses' => WorkOrder::getAllStatuses(),
            'all_types' => WorkOrder::getAllTypes(),
            'client' => $client->load(['work_orders.job']),
            'contractors' => Contractor::orderBy('name')->get(),
            'crews' => Crew::forWorkOrders()->active()->orderBy('name', 'desc')->get(),
            'jobs' => Job::with('extensions')->orderBy('name')->get(),
            'non_default_types' => WorkOrder::getNonDefaultTypes(),
            'non_default_types' => WorkOrder::getNonDefaultTypes(),
            'request' => $request,
            'work_order' => new WorkOrder,
            'url_back' => '',
        ]);
    }

    public function store(WorkOrderStoreRequest $request)
    {
        if(! $work_order = WorkOrder::create($request->validated()) ) {
            return back()->with('danger', "Error saving work order, try again please");
        }
        
        $work_order->members()->attach( 
            $work_order->crew->members->pluck('id')
        );

        if( $work_order->job->hasPreconfiguredRequiredInspections() )
        {
            foreach($work_order->job->preconfigured_required_inspections_array as $inspector_id) {
                Inspection::create([
                    'inspector_id' => $inspector_id,
                    'work_order_id' => $work_order->id,
                    'status' => 'pending',
                ]);
            }
        }

        $this->saveOrderByExtensions(
            $request->cache['extensions'],
            $request->cache['resolved_requests'], 
            $work_order,
            'store'
        );
        
        $route = $request->get('after_saving') == 1 ? route('work-orders.create', $work_order->client_id) : route('work-orders.index');

        return redirect($route)->with('success', "You saved the work order <b>#{$work_order->id}: {$work_order->job->name}</b>");
    }

    public function show(Request $request, WorkOrder $work_order)
    {
        $handler = new ShowAction( $request->get('tab', ShowAction::DEFAULT_RESPONSE) );

        return view('work-orders.show', $handler->build($work_order)->data([
            'request' => $request,
            'work_order' => $work_order,
        ]));
    }

    public function edit(WorkOrder $work_order, Request $request)
    {
        $this->reflashInputErrors();

        return view('work-orders.edit', [
            'all_statuses' => WorkOrder::getAllStatuses(),
            'all_types' => WorkOrder::getAllTypes(),
            'client' => $work_order->client->load(['work_orders.job']),
            'contractors' => Contractor::orderBy('name')->get(),
            'crews' => Crew::taskWorkOrders()->active()->orderBy('name', 'desc')->get(),
            'non_default_types' => WorkOrder::getNonDefaultTypes(),
            'request' => $request,
            'work_order' => $work_order,
        ]);
    }

    public function update(WorkOrderUpdateRequest $request, WorkOrder $work_order)
    {
        if(! $work_order->fill( $request->validated() )->save() ) {
            return back()->with('danger', 'Error updating work order, try again please');
        }

        $this->saveOrderByExtensions(
            $request->cache['extensions'],
            $request->cache['resolved_requests'],
            $work_order,
            'update'
        );

        $parameters = $request->filled('url_back') 
                    ? [$work_order, 'url_back' => $request->get('url_back')]
                    : $work_order;

        return redirect()->route('work-orders.edit', $parameters)->with('success', "You updated the work order <b>#{$work_order->id}</b>");
    }

    public function destroy(Request $request, WorkOrder $work_order)
    {
        if(! $work_order->delete() ) {
            return back()->with('danger', 'Error deleting work order, try again please');
        }        

        // Delete on extensions job

        return redirect()->route('work-orders.index')->with('success', "You deleted the work order <b>#{$work_order->id}</b>");
    }


    // Extensions

    private function saveOrderByExtensions(Collection $extensions, array $requests, WorkOrder $work_order, string $method)
    {
        foreach($extensions as $extension)
        {
            app($extension->work_order_controller)->callAction($method, [...$requests[$extension->id], $work_order]);
        }
    }
}
