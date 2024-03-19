<?php

namespace App\Models\Product\Traits;

use App\Models\Product;

trait BelongsProducts
{
    // Accessor

    public function getProductsCounterAttribute()
    {
        return ($this->products_count ?? $this->products->count());
    }


    // Validator

    public function hasProducts(): bool
    {
        return (bool) $this->products_counter;
    }
}
