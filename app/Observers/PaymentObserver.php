<?php

namespace App\Observers;

use App\Models\History;
use App\Models\Payment;

class PaymentObserver
{
    public function created(Payment $payment)
    {
        Payment::withoutEvents(function() use ($payment) {
            $payment->created_id = auth()->id();
            $payment->updated_id = auth()->id();
            $payment->save();
        });

        $payment->history()->create([
            'description' => "Payment #<b>{$payment->id}</b> of work order #<b>{$payment->work_order_id}</b> was created.",
            'link' => route('work-orders.show', $payment->work_order_id),
            'user_id' => auth()->id(),
        ]);
    }

    public function updated(Payment $payment)
    {
        Payment::withoutEvents(function() use ($payment) {
            $payment->updated_id = auth()->id();
            $payment->save();
        });

        $payment->history()->create([
            'description' => "Payment #<b>{$payment->id}</b> of work order #<b>{$payment->work_order_id}</b> was updated.",
            'link' => route('work-orders.show', $payment->work_order_id),
            'user_id' => auth()->id(),
        ]);
    }

    public function deleted(Payment $payment)
    {
        $payment->history()->delete();

        $payment->history()->create([
            'description' => "Payment #<b>{$payment->id}</b> of work order #<b>{$payment->work_order_id}</b> was deleted.",
            'link' => route('work-orders.show', $payment->work_order_id),
            'user_id' => auth()->id(),
        ]);
    }
}
