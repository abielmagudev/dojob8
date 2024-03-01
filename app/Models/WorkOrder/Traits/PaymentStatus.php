<?php

namespace App\Models\WorkOrder\Traits;

use Illuminate\Support\Facades\DB;

trait PaymentStatus
{
    protected static $payment_statuses = [
        'free',
        'paid',
        'unpaid',
    ];

    protected static $statuses_for_payment = [
        'completed',
        'denialed',
    ];


    // Scopes

    public function scopeWithRelationshipsForPayments($query)
    {
        return $query->with([
            'client',
            'contractor',
            'crew',
            'job',
        ]);
    }

    public function scopeForPayment($query)
    {
        return $query->whereIn('status', self::getStatusesForPayment()->toArray());
    }

    public function scopePaymentStatusUnpaid($query)
    {
        return $query->where('payment_status', 'unpaid');
    }

    public function scopePaymentStatusUnpaidCount($query)
    {
        return $query->select( DB::raw('COUNT(*) as count') )
                     ->whereIn('status', self::getStatusesForPayment()->toArray())
                     ->where('payment_status', 'unpaid')
                     ->first()
                     ->count;
    }


    // Filters

    public function scopeFilterByPaymentStatusGroup($query, $values)
    {
        if(! is_array($values) || empty($values) ) {
            return $query;
        }

        return $query->whereIn('payment_status', $values);
    }


    // Statics

    public static function getPaymentStatuses()
    {
        return collect( self::$payment_statuses );
    }

    public static function getStatusesForPayment()
    {
        return collect( self::$statuses_for_payment );
    }

    public static function inStatusesForPayment($value)
    {
        return self::getStatusesForPayment()->contains($value);
    }
}
