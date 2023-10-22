<?php

namespace App\Http\Controllers;

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

    public function create()
    {
        return view('orders.create', [
            'order' => new Order,
            'jobs' => Job::all(),
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
