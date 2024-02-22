<?php

namespace App\Xapis\Stock\WeatherizationProductCps\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{    
    protected $table = 'xapi_wpcps_categories';

    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
