<?php

namespace App\Apix\CpsProductMeasures\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{    
    protected $table = 'apix_cpspm_products';

    protected $fillable = [
        'name',
        'item_price_id',
        'material_price',
        'labor_price',
        'notes',
        'is_available',
        'category_id',
    ];
    
    public function getTotalCostAttribute()
    {
        return ($this->material_price + $this->labor_price);
    }

    public function isAvailable()
    {
        return (bool) $this->is_available;
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', 1);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
