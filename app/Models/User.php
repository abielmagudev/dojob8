<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Kernel\Interfaces\Filterable;
use App\Models\Kernel\Traits\HasActiveStatus;
use App\Models\Kernel\Traits\HasFiltering;
use App\Models\Kernel\Traits\HasHookUsers;
use App\Models\User\Kernel\AssistAuthTrait;
use App\Models\User\Kernel\AssistRolesTrait;
use App\Models\User\Kernel\ProfileContainer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements Filterable
{
    use HasApiTokens, HasFactory, Notifiable;

    use AssistAuthTrait;
    use AssistRolesTrait;
    use HasActiveStatus;
    use HasFiltering;
    use HasHookUsers;
    use HasRoles;
    use SoftDeletes;

    const NAME_PATTERN = "/^[a-zA-Z0-9_.]+$/";

    const PASSWORD_PATTERN = "/^[A-Za-z0-9_@#%!&*^()-=]+$/";

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_type',
        'profile_id',
        'last_session_at',
        'last_session_device',
        'last_session_ip',
        // 'last_session_geo_json',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_session_at' => 'datetime',
    ];

    protected $appends = [
        'profile_short',
        'profile_name',
    ];


    // Interface

    public function getParameterFilterSettings(): array
    {
        return [
            'profile' => 'filterByProfileType',
            'role' => 'filterByRole',
            'status' => 'filterByActive',
        ];
    }


    // Mutators

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }


    // Dates and times accessors

    public function getLastSessionDateHumanAttribute()
    {
        return $this->getRawOriginal('last_session_at') ? $this->last_session_at->format('D d, M Y') : null; 
    }

    public function getLastSessionTimeHumanAttribute()
    {
        return $this->getRawOriginal('last_session_at') ? $this->last_session_at->format('h:m A') : null; 
    }


    // Profile accessors

    public function getProfileShortAttribute()
    {
        return $this->profile->profile_short;
    }

    public function getProfileNameAttribute()
    {
        return $this->profile->profile_name;
    }

    public function getProfileClassAttribute()
    {
        return $this->profile_type;
    }


    // Filters

    public function scopeFilterByProfileType($query, $value)
    {
        if( empty($value) ||! $type = ProfileContainer::getType($value) ) {
            return $query;
        }

        return $query->where('profile_type', $type);
    }



    // Relationships

    public function profile()
    {
        return $this->morphTo(__FUNCTION__);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function history()
    {
        return $this->hasMany(History::class);
    }
}
