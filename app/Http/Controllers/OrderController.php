<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Client;
use App\Models\Job;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index', [
            'orders' => Order::with(['job', 'client'])->orderBy('scheduled_date', 'desc')->orderBy('scheduled_time', 'asc')->paginate(25),
        ]);
    }

    public function create(Client $client)
    {
        return view('orders.create', [
            'client' => $client,
            'jobs' => Job::all(),
            'order' => new Order,
        ]);
    }

    public function store(OrderStoreRequest $request)
    {
        if(! $order = Order::create($request->validated()) )
            return back()->with('danger', "Error saving order, try again please");

        $route = $request->get('after_saving') == 1 ? route('orders.create', $order->client_id) : route('orders.index');

        return redirect($route)->with('success', "Order <b>#{$order->id}: {$order->job->name}</b> saved");
    }

    public function show(Order $order)
    {
        return view('orders.show', [
            'order' => $order,
        ]);
    }

    public function edit(Order $order)
    {
        return view('orders.edit', [
            'order' => $order,
            'client' => $order->client,
        ]);
    }

    public function update(OrderUpdateRequest $request, Order $order)
    {
        if(! $order->fill( $request->validated() )->save() )
            return back()->with('danger', 'Error updating order, try again please');

        return redirect()->route('orders.edit', $order)->with('success', "Order <b>#{$order->id}: {$order->job->name}</b> updated");
    }

    public function destroy(Order $order)
    {
        return $order;
    }
}
