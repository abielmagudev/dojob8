<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Kernel\ReflashInputErrorsTrait;
use App\Http\Requests\WorkOrderStoreRequest;
use App\Http\Requests\WorkOrderUpdateRequest;
use App\Models\Client;
use App\Models\Intermediary;
use App\Models\Job;
use App\Models\WorkOrder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class WorkOrderController extends Controller
{
    use ReflashInputErrorsTrait;

    public function index()
    {
        return view('work-orders.index', [
            'work_orders' => WorkOrder::with(['job', 'client'])
                            ->orderBy('scheduled_date', 'desc')
                            ->orderBy('scheduled_time', 'asc')
                            ->paginate(25),
        ]);
    }

    public function create(Client $client)
    {
        $this->reflashInputErrors();

        return view('work-orders.create', [
            'client' => $client,
            'jobs' => Job::orderBy('name')->get(),
            'intermediaries' => Intermediary::orderBy('name')->get(),
            'work_order' => new WorkOrder,
        ]);
    }

    public function store(WorkOrderStoreRequest $request)
    {
        if(! $work_order = WorkOrder::create($request->validated()) )
            return back()->with('danger', "Error saving work order, try again please");

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
            'work_order' => $work_order,
            'client' => $work_order->client,
            'intermediaries' => Intermediary::orderBy('name')->get(),
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