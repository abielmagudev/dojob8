<?php

namespace App\Models\Payment\Services;

use App\Models\History;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;

class PaymentHistoryFactory
{
    public static function insert(Collection $payments)
    {
        $data = $payments->map(function($payment) {
            return [
                'description' => sprintf("Payment status of work order #%s updated to <b>%s</b>.", $payment->work_order_id, $payment->status),
                'link' => route('work-orders.show', $payment->work_order_id),
                'model_type' => Payment::class,
                'model_id' => $payment->id,
                'user_id' => auth()->id(),
            ];
        });

        return History::insert( $data->toArray() );
    }
}
