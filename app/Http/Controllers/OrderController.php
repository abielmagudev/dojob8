<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        return $request->all();
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

    public function update(Request $request, Order $order)
    {
        return $request->all();
    }

    public function destroy(Order $order)
    {
        return $order;
    }
}
