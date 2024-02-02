<?php

namespace App\Models;

use App\Models\Kernel\AuthenticatedInterface;
use App\Models\Kernel\FilteringInterface;
use App\Models\Kernel\HasContactChannelsTrait;
use App\Models\Kernel\HasFilteringTrait;
use App\Models\Kernel\HasHookUsersTrait;
use App\Models\Kernel\HasPresenceStatusTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model implements AuthenticatedInterface, FilteringInterface
{
    use HasContactChannelsTrait;
    use HasFactory;
    use HasFilteringTrait;
    use HasHookUsersTrait;
    use HasPresenceStatusTrait;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'last_name',
        'full_name',
        'birthdate',
        'phone_number',
        'mobile_number',
        'email',
        'position',
        'category',
        'is_available',
        'is_crew_member',
        'notes',
    ];

    protected $casts = [
        'birthdate' => 'date',
    ];


    // Interface

    public function getInputFilterSettings(): array
    {
        return [
            'status' => 'filterByAvailable',
            'is_crew_member' => 'filterByCrewMember',
        ];
    }

    public function getAuthenticatedNameAttribute(): string
    {
        return $this->full_name;
    }


    // Attributes

    public function getBirthdateInputAttribute()
    {
        return $this->hasBirthdate() ? $this->birthdate->format('Y-m-d') : null;
    }

    public function getBirthdateHumanAttribute()
    {
        return $this->hasBirthdate() ? $this->birthdate->format('d M, Y') : null;
    }


    // Validators 

    public function hasBirthdate()
    {
        return ! empty( $this->getOriginal('birthdate') );
    }

    public function isHappyBirthday()
    {
        return $this->hasBirthdate() && $this->birthdate->isBirthday();
    }

    public function hasPosition()
    {
        return ! empty($this->position);
    }

    public function isCrewMember()
    {
        return (bool) $this->is_crew_member;
    }

    public function hasCrews()
    {
        return (bool) $this->crews_count || $this->crews->count();
    }
 

    // Actions

    public function down()
    {
        $this->crews()->detach();

        if( $this->users ) {
            $this->users->each(fn($user) => $user->deactivate());
        }
    }

    public function up()
    {
        if( $this->users ) {
            $this->users->each(fn($user) => $user->activate());
        }
    }


    // Scopes

    public function scopeCrewMember($query)
    {
        return $query->where('is_crew_member', true);
    }


    // Filters

    public function scopeFilterByCrewMember($query, $value)
    {
        if( is_null($value) ||! in_array($value, [0, 1]) ) {
            return $query;
        }

        return $query->where('is_crew_member', $value);
    }


    // Relationships

    public function crews()
    {
        return $this->belongsToMany(Crew::class)->using(CrewMember::class);
    }

    public function work_orders()
    {
        return $this->belongsToMany(WorkOrder::class)->using(MemberWorkOrder::class);
    }

    public function users()
    {
        return $this->morphMany(User::class, 'profile'); // Old: morphOne(User::class, 'profile')
    }
}
