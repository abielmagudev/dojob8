<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Kernel\ReflashInputErrorsTrait;
use App\Http\Requests\WorkOrderStoreRequest;
use App\Http\Requests\WorkOrderUpdateRequest;
use App\Models\Client;
use App\Models\Contractor;
use App\Models\Crew;
use App\Models\Job;
use App\Models\Member;
use App\Models\WorkOrder;
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

        $scheduled_casted = $request->has('scheduled_date_range') ? [
            Carbon::parse( $request->input('scheduled_date_range.0') ),
            Carbon::parse( $request->input('scheduled_date_range.1') ),
        ] : Carbon::parse( $request->get('scheduled_date') );

        $work_orders = WorkOrder::with(['job', 'client', 'contractor', 'crew'])
        ->filtersByRequest($request)
        ->orderBy('scheduled_time', 'asc')
        ->orderBy('scheduled_date', $request->get('sort', 'desc'))
        ->paginate(25)
        ->appends( $request->query() );

        return view('work-orders.index', [
            'all_statuses' => WorkOrder::getAllStatuses(),
            'crews' => Crew::all(),
            'contractors' => Contractor::all(),
            'jobs' => Job::all(),
            'request' => $request,
            'scheduled_casted' => $scheduled_casted,
            'unfinished_work_orders' => [
                'url' => WorkOrder::generateUrlUnfinishedStatus(),
                'count' => WorkOrder::unfinishedStatus()->count(),
            ],
            'work_orders' => $work_orders,
        ]);
    }

    public function create(Client $client)
    {
        $this->reflashInputErrors();

        return view('work-orders.create', [
            'all_statuses' => WorkOrder::getAllStatuses(),
            'client' => $client,
            'crews' => Crew::with('members')->active()->orderBy('name', 'asc')->get(),
            'contractors' => Contractor::orderBy('name')->get(),
            'jobs' => Job::orderBy('name')->get(),
            'work_order' => new WorkOrder,
        ]);
    }

    public function store(WorkOrderStoreRequest $request)
    {
        if(! $work_order = WorkOrder::create($request->validated()) ) {
            return back()->with('danger', "Error saving work order, try again please");
        }
        
        $work_order->operators()->attach( 
            $work_order->crew->members->pluck('id')
        );

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
        $previous = WorkOrder::before($work_order->id)->first();
        $next = WorkOrder::after($work_order->id)->first();

        return view('work-orders.show', [
            'work_order' => $work_order,
            'routes' => [
                'previous' => $previous ? route('work-orders.show', $previous) : false,
                'next' => $next ? route('work-orders.show', $next) : false,
            ],
        ]);
    }

    public function edit(WorkOrder $work_order)
    {
        $this->reflashInputErrors();

        return view('work-orders.edit', [
            'all_statuses' => WorkOrder::getAllStatuses(),
            'client' => $work_order->client,
            'crews' => Crew::with('members')->get(),
            'contractors' => Contractor::orderBy('name')->get(),
            'operators' => Member::operative()->orderBy('full_name')->get(),
            'work_order' => $work_order,
        ]);
    }

    public function update(WorkOrderUpdateRequest $request, WorkOrder $work_order)
    {
        if(! $work_order->fill( $request->validated() )->save() )
            return back()->with('danger', 'Error updating work order, try again please');

        $this->saveOrderByExtensions(
            $request->cache['extensions'],
            $request->cache['resolved_requests'],
            $work_order,
            'update'
        );

        return redirect()->route('work-orders.edit', $work_order)->with('success', "You updated the work order <b>#{$work_order->id}</b>");
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
