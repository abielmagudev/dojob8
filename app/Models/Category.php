<?php

namespace App\Models;

use App\Models\History\Traits\HasHistory;
use App\Models\Kernel\Traits\BelongsCreatorUser;
use App\Models\Kernel\Traits\BelongsUpdaterUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Category extends Model
{
    use BelongsCreatorUser;
    use BelongsUpdaterUser;
    use HasFactory;
    use HasHistory;

    protected $fillable = [
        'name',
        'description',
    ];


    // Accessors

    public function getNameCamelCaseAttribute()
    {
        return Str::camel($this->name);
    }

    public function getProductsCounterAttribute()
    {
        return $this->products_count ?? $this->products->count();
    }


    // Validators

    public function hasDescription()
    {
        return ! empty($this->description);
    }

    public function hasProducts()
    {
        return (bool) $this->products_counter;
    }


    // Relationships
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
