<?php

namespace App\Models\WorkOrder\Traits;

trait PaymentStatus
{
    protected static $payment_statuses = [
        'free',
        'paid',
        'unpaid',
    ];

    protected static $statuses_for_payment_status = [
        'completed',
        'denialed',
    ];


    // Scopes

    public function scopeForPayment($query)
    {
        return $query->whereIn('status', self::getStatusesForPayment()->toArray());
    }


    // Statics

    public static function getPaymentStatuses()
    {
        return collect( self::$payment_statuses );
    }

    public static function getStatusesForPayment()
    {
        return collect( self::$statuses_for_payment_status );
    }

    public static function inStatusesForPayment($value)
    {
        return self::getStatusesForPayment()->contains($value);
    }
}
