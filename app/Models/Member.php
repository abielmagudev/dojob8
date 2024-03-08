<?php

namespace App\Models;

use App\Models\Kernel\Interfaces\Filterable;
use App\Models\Kernel\Traits\HasAvailableStatus;
use App\Models\Kernel\Traits\HasContactChannels;
use App\Models\Kernel\Traits\HasFiltering;
use App\Models\Kernel\Traits\HasHookUsers;
use App\Models\User\Interfaces\ProfileableUserContract;
use App\Models\User\Traits\HasUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Member extends Model implements Filterable, ProfileableUserContract
{
    use HasAvailableStatus;
    use HasContactChannels;
    use HasFactory;
    use HasFiltering;
    use HasHookUsers;
    use HasUsers;
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
        'is_crew_member',
        'notes',
        'is_available',
    ];

    protected $casts = [
        'birthdate' => 'date',
    ];


    // Interface

    public function getParameterFilterSettings(): array
    {
        return [
            'status' => 'filterByAvailable',
            'is_crew_member' => 'filterByCrewMember',
        ];
    }

    public function getProfileNameAttribute(): string
    {
        return $this->full_name;
    }


    // Mutators

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::title($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = Str::title($value);
    }

    public function setFullNameAttribute($value)
    {
        $this->attributes['full_name'] = Str::title($value);
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

    public function hasCrews()
    {
        return (bool) $this->crews_count || $this->crews->count();
    }

    public function isCrewMember()
    {
        return (bool) $this->is_crew_member;
    }
 

    // Actions

    public function down()
    {
        $this->crews()->detach();

        if( $this->users ) {
            $this->users->each(fn($user) => $user->saveInactive());
        }
    }

    public function up()
    {
        if( $this->users ) {
            $this->users->each(fn($user) => $user->saveActive());
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

    public function inspections()
    {
        return $this->belongsToMany(Inspection::class)->using(InspectionMember::class);
    }
}
