<?php

namespace App\Models;

use App\Models\Kernel\AuthenticatedInterface;
use App\Models\Kernel\HasAddressTrait;
use App\Models\Kernel\HasContactChannelsTrait;
use App\Models\Kernel\HasHookUsersTrait;
use App\Models\Kernel\Traits\HasActiveStatus;
use App\Models\WorkOrder\Associated\HasWorkOrdersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Contractor extends Model implements AuthenticatedInterface
{
    use HasAddressTrait;
    use HasContactChannelsTrait;
    use HasFactory;
    use HasHookUsersTrait;
    use HasActiveStatus;
    use HasWorkOrdersTrait;
    use SoftDeletes;
    
    protected $fillable = [
        'is_active',
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


    // Actions

    public function down()
    {
        $this->users->each(fn($user) => $user->saveInactive());
    }

    public function up()
    {
        $this->users->each(fn($user) => $user->saveActive());
    }


    // Relationships

    public function users()
    {
        return $this->morphMany(User::class, 'profile');
    }
}
