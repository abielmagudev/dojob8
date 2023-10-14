<?php

namespace App\Apix\WeatherizationMeasureCPS\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherizationMeasureCPSProduct extends Model
{
    protected $table = 'apix_weatherization_measure_cps_products';

    protected $fillable = [
        'name',
        'item_price_id',
        'material_price',
        'labor_price',
    ];
    
    public function getTotalCostAttribute()
    {
        return ($this->material_price + $this->labor_price);
    }
}
