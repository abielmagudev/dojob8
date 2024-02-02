<?php

namespace App\Models;

use App\Models\Kernel\FilteringInterface;
use App\Models\Kernel\HasFilteringTrait;
use App\Models\Kernel\HasHookUsersTrait;
use App\Models\Kernel\HasPresenceStatusTrait;
use App\Models\User\UserProfiler;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilteringInterface
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasHookUsersTrait;
    use HasPresenceStatusTrait;
    use HasFilteringTrait;
    use SoftDeletes;

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


    // Interface

    public function getInputFilterSettings(): array
    {
        return [
            'profile' => 'filterByProfile',
            'status' => 'filterByActive',
        ];
    }


    // Attributes

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getProfiledAttribute()
    {
        return UserProfiler::getProfileByClassname($this->profile_type);
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

    public function isProfiled(string $value)
    {
        return $this->profiled == $value;
    }


    // Filters

    public function scopeFilterByProfile($query, $value)
    {
        if( empty($value) ||! $classname = UserProfiler::getClassnameByProfile($value) ) {
            return $query;
        }

        return $query->where('profile_type', $classname);
    }


    // Relationships

    public function profile()
    {
        return $this->morphTo(__FUNCTION__);
    }

    public function history()
    {
        return $this->hasMany(History::class);
    }
}
