<?php

namespace App\Apix\Stock\CpsProductMeasures\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{    
    protected $table = 'apix_cpspm_categories';

    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
