<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentUpdateRequest;
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
        ->forPayment()
        ->filterByParameters( $request->all() )
        ->orderBy('scheduled_date', $request->get('sort', 'desc'))
        ->paginate(25)
        ->appends($request->query());

        return view('payments.index', [
            'contractors' => Contractor::all(),
            'jobs' => Job::all(),
            'payment_statuses' => WorkOrder::getPaymentStatuses(),
            'request' => $request,
            'work_orders' => $work_orders,
        ]);
    }

    public function updateMany(PaymentUpdateRequest $request)
    {
        if(! WorkOrder::whereIn('id', $request->get('work_orders'))->update(['payment_status' => $request->get('payment')]) ) {
            return back()->with('danger', 'Error updating the payment of work orders, try again please');
        }

        $payment_status = WorkOrder::getPaymentStatuses()->search( $request->get('payment') );

        return back()->with('success', sprintf('These #%s work orders were updated with payment <b>%s</b>', implode(', #', $request->get('work_orders')), strtoupper($payment_status)) );
    }
}
