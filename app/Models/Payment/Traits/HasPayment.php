<?php

namespace App\Models\Payment\Traits;

use App\Models\Payment;

trait HasPayment
{
    // Relationships

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
