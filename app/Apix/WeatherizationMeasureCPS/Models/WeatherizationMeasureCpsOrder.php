<?php

namespace App\Apix\WeatherizationMeasureCps\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherizationMeasureCpsOrder extends Model
{
    protected $table = 'apix_weatherization_measures_cps_order';

    protected $fillable = [
        'name',
        'quantity',
        'measure_id',
        'order_id',
    ];

    public function product()
    {
        return $this->belongsTo(WeatherizationMeasureCps::class, 'measure_id');
    }
}
