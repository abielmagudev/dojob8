<?php

namespace App\Apix\WeatherizationMeasureCps\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherizationProductCpsOrder extends Model
{
    protected $table = 'apix_weatherization_products_cps_orders';

    public $timestamps = false;

    protected $fillable = [
        'quantity',
        'measure_id',
        'order_id',
    ];

    public function scopeWhereOrder($query, $order_id)
    {
        return $query->where('order_id', $order_id);
    }

    public function measure()
    {
        return $this->belongsTo(WeatherizationMeasureCps::class, 'measure_id');
    }
}
