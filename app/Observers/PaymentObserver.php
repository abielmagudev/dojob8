<?php

namespace App\Observers;

use App\Models\History;
use App\Models\Payment;

class PaymentObserver
{
    public function created(Payment $payment)
    {
        Payment::withoutEvents(function() use ($payment) {
            $payment->created_by = auth()->id();
            $payment->updated_by = auth()->id();
            $payment->save();
        });

        History::create([
            'description' => sprintf("<em>Payment was created for work order #%s.", $payment->work_order_id),
            'link' => route('work-orders.show', $payment->work_order_id),
            'model_type' => Payment::class,
            'model_id' => $payment->id,
            'user_id' => auth()->id(),
        ]);
    }

    public function updated(Payment $payment)
    {
        Payment::withoutEvents(function() use ($payment) {
            $payment->updated_by = auth()->id();
            $payment->save();
        });

        History::create([
            'description' => sprintf("Payment status of work order #%s updated to <b>%s</b>.", $payment->work_order_id, $payment->status),
            'link' => route('work-orders.show', $payment->work_order_id),
            'model_type' => Payment::class,
            'model_id' => $payment->id,
            'user_id' => auth()->id(),
        ]);
    }
}
