<?php

namespace App\Http\Controllers;

use App\Http\Controllers\WorkOrderController\Index\AuthDataLoader;
use App\Http\Controllers\WorkOrderController\Index\RequestInitializer;
use App\Http\Controllers\WorkOrderController\ShowAction;
use App\Http\Requests\WorkOrderStoreRequest;
use App\Http\Requests\WorkOrderUpdateRequest;
use App\Models\Client;
use App\Models\Contractor;
use App\Models\Crew;
use App\Models\Job;
use App\Models\Media\Kernel\MediaFileDestroyer;
use App\Models\WorkOrder;
use App\Models\WorkOrder\Kernel\WorkOrderStatusCatalog;
use App\Models\WorkOrder\Kernel\WorkOrderTypeCatalog;
use App\Models\WorkOrder\Services\InspectionFactoryService;
use App\Models\WorkOrder\Services\PaymentFactoryService;
use Illuminate\Http\Request;

class WorkOrderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(WorkOrder::class, 'work_order');
    }

    public function index(Request $request)
    {
        $request = RequestInitializer::make($request);

        if(! $loader = AuthDataLoader::get($request) ) {
            abort(404);
        }

        return view('work-orders.index', $loader->data());
    }

    public function create(Request $request)
    {
        $client = Client::findOrFail($request->client);

        $client->load('work_orders.job');

        return view('work-orders.create', [
            'all_statuses' => WorkOrderStatusCatalog::all(),
            'all_types' => WorkOrderTypeCatalog::all(),
            'client' => $client,
            'contractors' => Contractor::orderBy('name')->get(),
            'crews' => Crew::purposeWorkOrders()->active()->orderBy('name', 'desc')->get(),
            'jobs' => Job::orderBy('name')->get(),
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
            $work_order->attachCrewMembers();
        }
        
        InspectionFactoryService::create($work_order);

        PaymentFactoryService::create($work_order);
        
        $route = $request->get('after_saving') == 1 ? route('work-orders.create', ['client' => $work_order->client_id]) : route('work-orders.index');

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
        return view('work-orders.edit', [
            'all_statuses' => WorkOrderStatusCatalog::all(),
            'all_types' => WorkOrderTypeCatalog::all(),
            'client' => $work_order->client->load(['work_orders.job']),
            'contractors' => Contractor::orderBy('name')->get(),
            'crews' => Crew::purposeWorkOrders()->active()->orderBy('name', 'desc')->get(),
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

        $parameters = $request->filled('url_back') ? [$work_order, 'url_back' => $request->get('url_back')] : $work_order;

        return redirect()->route('work-orders.edit', $parameters)->with('success', "You updated the work order <b>#{$work_order->id}</b>");
    }

    public function destroy(Request $request, WorkOrder $work_order)
    {
        if(! $work_order->delete() ) {
            return back()->with('danger', 'Error deleting work order, try again please');
        }        

        MediaFileDestroyer::byWorkOrder($work_order);

        $work_order->media()->delete();

        $work_order->history()->delete();

        return redirect()->route('work-orders.index')->with('success', "You deleted the work order <b>#{$work_order->id}</b>");
    }
}
