<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PaymentController\Index\RequestHandler;
use App\Http\Controllers\PaymentController\Services\PaymentUrlGenerator;
use App\Http\Requests\PaymentUpdateRequest;
use App\Models\Payment;
use App\Models\Payment\Services\PaymentHistoryFactory;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Payment::class, 'payment');
    }

    public function index(Request $request)
    {
        $request = RequestHandler::handle($request);

        $payments = Payment::withEssentialRelationships()
        ->withNestedRelationships()
        ->filterByParameters( $request->all() )
        ->orderBy('id', $request->get('sort', 'desc'))
        ->paginate(35)
        ->appends($request->query());

        return view('payments.index', [
            'all_statuses' => Payment::collectionAllStatuses(),
            'payments' => $payments,
            'request' => $request,
            'filtering' => [
                'unpaid' => [
                    'url' => PaymentUrlGenerator::unpaid(),
                    'count' => Payment::unpaidCount()->first()->unpaid_count,
                ],
            ],
        ]);
    }

    public function update(PaymentUpdateRequest $request)
    {
        $result = Payment::whereIn('id', $request->get('payments'))->update([
            'status' => $request->get('status'),
        ]);

        if( $result === false ) {
            return redirect($request->get('url_back'))->with('danger', 'Error updating the payment status, try again...');
        }

        PaymentHistoryFactory::insert(
            Payment::whereIn('id', $request->get('payments'))->get()
        );

        $comparison_updated = sprintf('%s/%s', count($request->get('payments')), $result);
        $status_uppercase = strtoupper($request->get('status'));

        return redirect($request->get('url_back'))->with('success', "{$comparison_updated} Payments were updated with the status <b>{$status_uppercase}</b>");
    }
}
