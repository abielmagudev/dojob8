<?php

namespace App\Apix\Kernel;

use App\Models\Order;

trait RelationshipOrderTrait
{
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
