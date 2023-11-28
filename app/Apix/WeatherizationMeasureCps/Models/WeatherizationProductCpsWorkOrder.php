<?php

namespace App\Apix\WeatherizationMeasureCps\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherizationProductCpsWorkOrder extends Model
{
    protected $table = 'apix_weatherization_products_cps_work_orders';

    public $timestamps = false;

    protected $fillable = [
        'quantity',
        'measure_id',
        'work_order_id',
    ];

    public function scopeWhereWorkOrder($query, $work_order_id)
    {
        return $query->where('work_order_id', $work_order_id);
    }

    public function measure()
    {
        return $this->belongsTo(WeatherizationMeasureCps::class, 'measure_id');
    }
}
