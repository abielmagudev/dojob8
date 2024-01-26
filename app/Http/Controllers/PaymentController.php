<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use App\Models\Job;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if( count($request->all()) == 0 ) {
            $request->merge(['payment_status_group' => [0]]);
        }

        $work_orders = WorkOrder::with(['contractor','job','crew'])
        ->filterByInputs( $request->all() )
        ->orderBy('scheduled_date', 'asc')
        ->paginate( 25 )
        ->appends( $request->query() );

        return view('payments.index', [
            'contractors' => Contractor::all(),
            'jobs' => Job::all(),
            'payment_statuses' => WorkOrder::getPaymentStatuses(),
            'request' => $request,
            'work_orders' => $work_orders,
        ]);
    }

    public function updateMany(Request $request)
    {
        return $request->all();
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

    // public function update(Request $request, Payment $payment)
    // {
    //     //
    // }

    // public function destroy(Payment $payment)
    // {
    //     //
    // }
}
