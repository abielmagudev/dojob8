<?php

namespace App\Models;

use App\Models\Kernel\AuthenticatedInterface;
use App\Models\Kernel\HasAddressTrait;
use App\Models\Kernel\HasContactMeans;
use App\Models\Kernel\HasExistenceTrait;
use App\Models\Kernel\HasHookUsersTrait;
use App\Models\WorkOrder\HasWorkOrdersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Contractor extends Model implements AuthenticatedInterface
{
    use HasAddressTrait;
    use HasContactMeans;
    use HasExistenceTrait;
    use HasFactory;
    use HasHookUsersTrait;
    use HasWorkOrdersTrait;
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'alias',
        'contact_name',
        'phone_number',
        'mobile_number',
        'email',
        'street',
        'city_name',
        'state_code',
        'country_code',
        'zip_code',
        'notes',
        'is_available',
    ];


    // Interface

    public function getAuthenticatedNameAttribute(): string
    {
        return "{$this->name} ($this->alias)";
    }


    // Attributes

    public function setContactNameAttribute($value)
    {
        $this->attributes['contact_name'] = Str::title($value);
    }

    public function getStatusAttribute()
    {
        return $this->isAvailable() ? 'available' : 'not available';
    }


    // Relationships

    public function user()
    {
        return $this->morphMany(User::class, 'profile');
    }
}
