<?php

namespace App\Models;

use App\Models\History\Traits\HasHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use HasHistory;

    protected $fillable = [
        'name',
        'item_price_id',
        'material_price',
        'labor_price',
        'unit_price',
        'description',
    ];


    // Accessors

    public function getMaterialPriceCurrencyAttribute()
    {
        return number_format($this->material_price, 2, '.', ', ');
    }

    public function getLaborPriceCurrencyAttribute()
    {
        return number_format($this->labor_price, 2, '.', ', ');
    }

    public function getUnitPriceCurrencyAttribute()
    {
        return number_format($this->unit_price, 2, '.', ', ');
    }
}
