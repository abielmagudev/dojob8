<?php

namespace App\Models;

use App\Models\Kernel\HasAvailabilityTrait;
use App\Models\Kernel\HasBeforeAfterTrait;
use App\Models\Kernel\HasCountryStateCodesTrait;
use App\Models\Kernel\HasHookUsersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Intermediary extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasAvailabilityTrait;
    use HasBeforeAfterTrait;
    use HasCountryStateCodesTrait;
    use HasHookUsersTrait;
    
    protected $fillable = [
        'name',
        'alias',
        'contact',
        'phone_number',
        'mobile_number',
        'email',
        'street',
        'city',
        'state_code',
        'country_code',
        'zip_code',
        'notes',
        'is_available',
    ];


    // Attributes

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
        return $this->isAvailable() ? 'available' : 'not available';
    }

    public function getContactDataCollectionAttribute()
    {
        return collect([
            'phone'  => $this->phone_number,
            'mobile' => $this->mobile_number,
            'email'  => $this->email,
        ]);
    }


    // Relationships
    
    public function work_orders()
    {
        return $this->hasMany(WorkOrder::class);
    }
}
