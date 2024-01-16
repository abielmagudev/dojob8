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

    public function inputFilterSettings(): array
    {
        return [
            'status' => 'filterByStatus',
            'profile' => 'filterByProfile',
        ];
    }


    // Attributes

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
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


    // Scopes

    public function scopeWhereProfileType($query, string $value)
    {
        return $query->where('profile_type', $value);
    }


    // Filters

    public function scopeFilterByStatus($query, $value)
    {
        return in_array($value, ['0','1']) ? $query->whereActive($value) : $query;
    }

    public function scopeFilterByProfile($query, $value)
    {
        if( empty($value) ||! $profile = UserProfiler::getProfileByAlias($value) ) {
            return $query;
        }

        return $query->whereProfileType($profile);
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
