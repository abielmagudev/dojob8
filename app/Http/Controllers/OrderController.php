<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Kernel\ReflashInputErrorsTrait;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Client;
use App\Models\Intermediary;
use App\Models\Job;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ReflashInputErrorsTrait;

    public function index()
    {
        return view('orders.index', [
            'orders' => Order::with(['job', 'client'])->orderBy('scheduled_date', 'desc')->orderBy('scheduled_time', 'asc')->paginate(25),
        ]);
    }

    public function create(Client $client)
    {
        $this->reflashInputErrors();

        return view('orders.create', [
            'client' => $client,
            'jobs' => Job::orderBy('name')->get(),
            'intermediaries' => Intermediary::orderBy('name')->get(),
            'order' => new Order,
        ]);
    }

    public function store(OrderStoreRequest $request)
    {
        if(! $order = Order::create($request->validated()) )
            return back()->with('danger', "Error saving order, try again please");

        $this->saveOrderByExtensions(
            $request->cache['extensions'],
            $request->cache['resolved_requests'], 
            $order,
            'store'
        );
        
        $route = $request->get('after_saving') == 1 ? route('orders.create', $order->client_id) : route('orders.index');

        return redirect($route)->with('success', "Order <b>#{$order->id}: {$order->job->name}</b> saved");
    }

    public function show(Request $request, Order $order)
    {
        $previous = Order::before($order->id)->first();
        $next = Order::after($order->id)->first();

        return view('orders.show', [
            'order' => $order,
            'routes' => [
                'previous' => $previous ? route('orders.show', $previous) : false,
                'next' => $next ? route('orders.show', $next) : false,
            ],
        ]);
    }

    public function edit(Order $order)
    {
        $this->reflashInputErrors();

        return view('orders.edit', [
            'order' => $order,
            'client' => $order->client,
            'intermediaries' => Intermediary::orderBy('name')->get(),
        ]);
    }

    public function update(OrderUpdateRequest $request, Order $order)
    {
        if(! $order->fill( $request->validated() )->save() )
            return back()->with('danger', 'Error updating order, try again please');

        $this->saveOrderByExtensions(
            $request->cache['extensions'],
            $request->cache['resolved_requests'],
            $order,
            'update'
        );

        return redirect()->route('orders.edit', $order)->with('success', "Order <b>#{$order->id}: {$order->job->name}</b> updated");
    }

    public function destroy(Request $request, Order $order)
    {
        if(! $order->delete() ) {
            return back()->with('danger', 'Error deleting order, try again please');
        }        

        // Delete on extensions job

        return redirect()->route('orders.index')->with('success', "Order #{$order->id} deleted");
    }


    // Extensions

    private function saveOrderByExtensions(Collection $extensions, array $requests, Order $order, string $method)
    {
        foreach($extensions as $extension)
        {
            app($extension->order_controller)->callAction($method, [...$requests[$extension->id], $order]);
        }
    }
}
