<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Kernel\ReflashInputErrorsTrait;
use App\Http\Controllers\WorkOrderController\Index\AuthDataRetriever;
use App\Http\Controllers\WorkOrderController\Index\RequestManipulator;
use App\Http\Controllers\WorkOrderController\ShowAction;
use App\Http\Controllers\WorkOrderController\WorkOrderUrlGenerator;
use App\Http\Requests\WorkOrderStoreRequest;
use App\Http\Requests\WorkOrderUpdateRequest;
use App\Models\Client;
use App\Models\Contractor;
use App\Models\Crew;
use App\Models\Inspection;
use App\Models\Job;
use App\Models\WorkOrder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class WorkOrderController extends Controller
{
    use ReflashInputErrorsTrait;

    public function __construct()
    {
        $this->authorizeResource(WorkOrder::class, 'work_order');
    }

    public function index(Request $request)
    {
        $request = RequestManipulator::manipulate($request);
        
        $data = AuthDataRetriever::get($request);

        return view('work-orders.index', $data);
    }

    public function create(Client $client)
    {
        $this->reflashInputErrors();

        $client->load('work_orders.job');

        return view('work-orders.create', [
            'all_statuses' => WorkOrder::collectionAllStatuses(),
            'all_types' => WorkOrder::collectionAllTypes(),
            'client' => $client,
            'contractors' => Contractor::orderBy('name')->get(),
            'crews' => Crew::taskWorkOrders()->active()->orderBy('name', 'desc')->get(),
            'jobs' => Job::with('extensions')->orderBy('name')->get(),
            'work_order' => new WorkOrder,
            'work_orders_for_rectification' => $client->onlyWorkOrdersForRectification(),
        ]);
    }

    public function store(WorkOrderStoreRequest $request)
    {
        if(! $work_order = WorkOrder::create($request->validated()) ) {
            return back()->with('danger', "Error saving work order, try again please");
        }
        
        //?
        if( $work_order->hasCrew() ) {
            $work_order->attachWorkers();
        }

        //?
        if( $work_order->job->requiresApprovedInspections() ) {
            $work_order->updateInspectionStatus();
        }
        
        if( $work_order->job->hasInspectionsSetup() ) {
            Inspection::generateByWorkOrderSetup($work_order);
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

    public function edit(Request $request, WorkOrder $work_order)
    {
        $this->reflashInputErrors();

        return view('work-orders.edit', [
            'all_form_statuses' => WorkOrder::collectionAllStatuses(),
            'all_types' => WorkOrder::collectionAllTypes(),
            'client' => $work_order->client->load(['work_orders.job']),
            'contractors' => Contractor::orderBy('name')->get(),
            'crews' => Crew::taskWorkOrders()->active()->orderBy('name', 'desc')->get(),
            'request' => $request,
            'work_order' => $work_order,
            'work_orders_for_rectification' => $work_order->client->onlyWorkOrdersForRectification($work_order),
            'url_back' => $request->filled('url_back') ? $request->get('url_back') : route('work-orders.show', $work_order),
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

        $parameters = $request->filled('url_back') ? [$work_order, 'url_back' => $request->get('url_back')] : $work_order;

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
            app($extension->xapi_work_order_controller)->callAction($method, [...$requests[$extension->id], $work_order]);
        }
    }
}
