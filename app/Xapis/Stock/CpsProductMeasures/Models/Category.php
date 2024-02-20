<?php

namespace App\Xapis\Stock\CpsProductMeasures\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{    
    protected $table = 'xapi_cpspm_categories';

    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
