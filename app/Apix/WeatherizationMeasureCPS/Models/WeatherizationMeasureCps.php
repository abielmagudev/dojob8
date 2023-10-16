<?php

namespace App\Apix\WeatherizationMeasureCps\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherizationMeasureCps extends Model
{
    protected $table = 'apix_weatherization_measures_cps';

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
