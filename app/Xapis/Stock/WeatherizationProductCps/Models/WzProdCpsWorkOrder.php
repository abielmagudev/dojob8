<?php

namespace App\Xapis\Stock\WeatherizationProductCps\Models;

use App\Models\WorkOrder;
use Illuminate\Database\Eloquent\Model;

class WzProdCpsWorkOrder extends Model
{
    protected $table = 'xapi_wzprodcps_work_orders';

    public $timestamps = false;

    protected $fillable = [
        'quantity',
        'product_id',
        'work_order_id',
    ];

    public function scopeWhereWorkOrder($query, $work_order_id)
    {
        return $query->where('work_order_id', $work_order_id);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function work_order()
    {
        return $this->belongsTo(WorkOrder::class);
    }
}
