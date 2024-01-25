<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payments.index', [
            'work_orders' => WorkOrder::with(['contractor','job','crew'])->unpaid()->get(),
        ]);
    }

    // public function create()
    // {
    //     //
    // }

    // public function store(Request $request)
    // {
    //     //
    // }

    // public function show(Payment $payment)
    // {
    //     //
    // }

    // public function edit(Payment $payment)
    // {
    //     //
    // }

    public function update(Request $request, WorkOrder $work_order)
    {
        //
    }

    // public function destroy(Payment $payment)
    // {
    //     //
    // }
}
