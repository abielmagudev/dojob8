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

    public function scopeUpdatePaymentStatus($query, $value)
    {
        return $query->update(['payment_status' => $value]);
    }

    public function scopeUpdatePaymentStatusById($query, $value, array $values)
    {
        return $query->whereIn('id', $values)->updatePaymentStatus($value);
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

    public static function initialPaymentStatus()
    {
        return 'unpaid';
    }

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
