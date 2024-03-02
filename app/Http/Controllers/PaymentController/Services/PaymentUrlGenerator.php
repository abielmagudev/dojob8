<?php

namespace App\Http\Controllers\PaymentController\Services;

use App\Models\Payment;

class PaymentUrlGenerator
{
    public static function all(array $parameters = [])
    {
        return route('payments.index', array_merge($parameters, [
            'dates' => 'any',
        ]));
    }

    public static function unpaid(array $parameters = [])
    {
        return route('payments.index', array_merge($parameters, [
            'status_group' => [Payment::INITIAL_STATUS],
            'sort' => 'asc',
            'dates' => 'any',
        ]));
    }
}
