<?php

namespace App\Models;

use App\Models\Kernel\AuthenticatedUserMetadataInterface;
use App\Models\Kernel\FilteringInterface;
use App\Models\Kernel\HasAddressTrait;
use App\Models\Kernel\HasExistenceTrait;
use App\Models\Kernel\HasFilteringTrait;
use App\Models\Kernel\HasHookUsersTrait;
use App\Models\WorkOrder\HasWorkOrdersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Contractor extends Model implements AuthenticatedUserMetadataInterface
{
    use HasAddressTrait;
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


    // Attributes

    public function setContactNameAttribute($value)
    {
        $this->attributes['contact_name'] = Str::title($value);
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

    public function getMetaNameAttribute(): string
    {
        return "{$this->name} ($this->alias)";
    }



    // Relationships

    public function user()
    {
        return $this->morphMany(User::class, 'profile');
    }
}
