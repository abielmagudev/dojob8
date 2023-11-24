<?php

namespace App\Models;

use App\Models\Kernel\HasBeforeAfterTrait;
use App\Models\Kernel\HasCountryStateCodesTrait;
use App\Models\Kernel\HasModifiersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Intermediary extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasBeforeAfterTrait;
    use HasCountryStateCodesTrait;
    use HasModifiersTrait;
    
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

    public function getStatusAttribute()
    {
        return $this->isAvailable() ? 'available' : 'unavailable';
    }

    public function isAvailable()
    {
        return (bool) $this->is_available;
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', 1);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
