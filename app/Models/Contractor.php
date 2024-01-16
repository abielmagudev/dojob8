<?php

namespace App\Models;

use App\Models\Kernel\AuthenticatedInterface;
use App\Models\Kernel\HasAddressTrait;
use App\Models\Kernel\HasContactChannelsTrait;
use App\Models\Kernel\HasExistenceTrait;
use App\Models\Kernel\HasHookUsersTrait;
use App\Models\Kernel\HasPresenceStatusTrait;
use App\Models\WorkOrder\HasWorkOrdersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Contractor extends Model implements AuthenticatedInterface
{
    use HasAddressTrait;
    use HasContactChannelsTrait;
    use HasExistenceTrait;
    use HasFactory;
    use HasHookUsersTrait;
    use HasPresenceStatusTrait;
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


    // Relationships

    public function user()
    {
        return $this->morphMany(User::class, 'profile');
    }
}
