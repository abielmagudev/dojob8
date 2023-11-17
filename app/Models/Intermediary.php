<?php

namespace App\Models;

use App\Helpers\CountryManager;
use App\Models\Kernel\HasAvailableTrait;
use App\Models\Kernel\HasCountryStateCodesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Intermediary extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasCountryStateCodesTrait;
    use HasAvailableTrait;
    
    protected $fillable = [
        'name',
        'alias',
        'contact',
        'phone_number',
        'mobile_number',
        'email',
        'street',
        'zip_code',
        'country_code',
        'state_code',
        'city',
        'notes',
        'is_available',
    ];

    public function setContactAttribute($value)
    {
        $this->attributes['contact'] = Str::title($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
