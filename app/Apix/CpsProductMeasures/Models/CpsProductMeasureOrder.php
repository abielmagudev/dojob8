<?php

namespace App\Apix\CpsProductMeasures\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class CpsProductMeasureOrder extends Model
{
    protected $table = 'apix_cpspm_orders';

    public $timestamps = false;

    protected $fillable = [
        'quantity',
        'product_id',
        'order_id',
    ];

    public function scopeWhereOrder($query, $order_id)
    {
        return $query->where('order_id', $order_id);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
