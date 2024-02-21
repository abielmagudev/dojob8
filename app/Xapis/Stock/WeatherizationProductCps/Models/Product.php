<?php

namespace App\Xapis\Stock\WeatherizationProductCps\Models;

use App\Models\Kernel\Traits\HasAvailableStatus;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{    
    use HasAvailableStatus;

    protected $table = 'xapi_weatherization_product_cps_products';

    protected $fillable = [
        'name',
        'item_price_id',
        'material_price',
        'labor_price',
        'notes',
        'is_available',
        'category_id',
    ];
    

    // Attributes

    public function getUnitPriceAttribute()
    {
        return ($this->material_price + $this->labor_price);
    }


    // Validators

    public function hasCategory()
    {
        return ! empty($this->category_id) && is_a($this->category, Category::class);
    }


    // Relationships

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
