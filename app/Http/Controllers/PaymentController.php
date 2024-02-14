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
        if( empty($request->all()) )
        {
            $request->merge([
                'payment_status_group' => [WorkOrder::initialPaymentStatus()],
                'dates' => 'any',
            ]);
        }

        $work_orders = WorkOrder::withRelationshipsForPayments()
        ->filterByParameters( $request->all() )
        ->forPayment()
        ->orderBy('scheduled_date', $request->get('sort', 'desc'))
        ->paginate(35)
        ->appends($request->query());

        return view('payments.index', [
            'contractors' => Contractor::all(),
            'jobs' => Job::all(),
            'payment_status_unpaid_count' => WorkOrder::paymentStatusUnpaidCount(),
            'payment_statuses' => WorkOrder::getPaymentStatuses(),
            'request' => $request,
            'work_orders' => $work_orders,
        ]);
    }

    public function update(PaymentUpdateRequest $request)
    {
        $result = WorkOrder::whereIn('id', $request->get('work_orders'))->update([
            'payment_status' => $request->get('payment_status'),
        ]);

        if( $result === false ) {
            return redirect($request->get('url_back'))->with('danger', 'Error updating the payment status of work orders, try again...');
        }

        $payment_status_uppercase = strtoupper($request->get('payment_status'));
        $comparison_updated = sprintf('%s/%s', count($request->get('work_orders')), $result);

        return redirect($request->get('url_back'))->with('success', "{$comparison_updated} Work orders were updated with the payment status of <b>{$payment_status_uppercase}</b>");
    }
}
