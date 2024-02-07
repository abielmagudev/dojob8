<?php

namespace App\Models;

use App\Models\Kernel\Interfaces\Authenticable;
use App\Models\Kernel\Traits\HasActiveStatus;
use App\Models\Kernel\Traits\HasAddress;
use App\Models\Kernel\Traits\HasContactChannels;
use App\Models\Kernel\Traits\HasHookUsers;
use App\Models\WorkOrder\Associated\HasWorkOrdersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Contractor extends Model implements Authenticable
{
    use HasActiveStatus;
    use HasAddress;
    use HasContactChannels;
    use HasFactory;
    use HasHookUsers;
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
