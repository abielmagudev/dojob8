<?php

namespace App\Models;

use App\Models\Kernel\HasAvailabilityTrait;
use App\Models\Kernel\HasBeforeAfterTrait;
use App\Models\Kernel\HasHookUsersTrait;
use App\Models\User\UserProfiler;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    use HasAvailabilityTrait;
    use HasBeforeAfterTrait;
    use HasHookUsersTrait;

    const NAME_PATTERN = "/^[a-zA-Z0-9_.]+$/";

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_type',
        'profile_id',
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


    // Attributes

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getStatusAttribute()
    {
        return $this->isActive() ? 'active' : 'inactive';
    }

    public function getProfileAliasAttribute()
    {
        return UserProfiler::getAliasByProfile($this->profile_type);
    }

    public function getLastSessionDateHumanAttribute()
    {
        return $this->getRawOriginal('last_session_at') ? $this->last_session_at->format('D d, M Y') : null; 
    }

    public function getLastSessionTimeHumanAttribute()
    {
        return $this->getRawOriginal('last_session_at') ? $this->last_session_at->format('h:m A') : null; 
    }


    // Validators

    public function isProfileAlias(string $profile_alias)
    {
        return $this->profile_alias == $profile_alias;
    }


    // Relationships

    public function profile()
    {
        return $this->morphTo(__FUNCTION__, 'profile_type', 'profile_id');
    }

    public function history()
    {
        return $this->hasMany(History::class);
    }
}
