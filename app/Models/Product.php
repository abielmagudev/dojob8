<?php

namespace App\Models;

use App\Models\History\Traits\HasHistory;
use App\Models\Kernel\Traits\BelongsCreatorUser;
use App\Models\Kernel\Traits\BelongsDeleterUser;
use App\Models\Kernel\Traits\BelongsUpdaterUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use BelongsCreatorUser;
    use BelongsDeleterUser;
    use BelongsUpdaterUser;
    use HasFactory;
    use HasHistory;

    protected $fillable = [
        'name',
        'description',
        'measurement_unit',
        'item_price_id',
        'material_price',
        'labor_price',
        // 'unit_price',
        'category_id',
    ];

    protected $appends = [
        'category_name',
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

    public function getUnitPriceAttribute()
    {
        return ($this->material_price + $this->labor_price);
    }

    public function getCategoryNameAttribute()
    {
        return $this->existsCategory() ? $this->category->name : 'uncategorized';
    }


    // Validators

    public function hasCategory()
    {
        return ! empty($this->category_id);
    }   

    public function existsCategory()
    {
        return $this->hasCategory() && is_a($this->category, Category::class);
    }


    // Relationships

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    // Scopes

    public function scopeCategorized($query)
    {
        return $query->whereNotNull('category_id');
    }

    public function scopeUncategorized($query)
    {
        return $query->whereNull('category_id');
    }
}
