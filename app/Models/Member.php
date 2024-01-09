<?php

namespace App\Models;

use App\Models\Kernel\AuthenticatedUserMetadataInterface;
use App\Models\Kernel\FilteringInterface;
use App\Models\Kernel\HasExistenceTrait;
use App\Models\Kernel\HasFilteringTrait;
use App\Models\Kernel\HasHookUsersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model implements AuthenticatedUserMetadataInterface, FilteringInterface
{
    use HasFilteringTrait;
    use HasExistenceTrait;
    use HasFactory;
    use HasHookUsersTrait;
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
        'is_active',
        'is_crew_member',
        'notes',
    ];

    protected $casts = [
        'birthdate' => 'date',
    ];


    // Interface

    public function inputsAndFilters(): array
    {
        return [
            'status' => 'filterByStatus',
            'is_crew_member' => 'filterByIsCrewMember',
            'sort_prop' => ['filterBySortProp', 'sort_prop_way'],
        ];
    }

    public function getMetaNameAttribute(): string
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

    public function getContactDataCollectionAttribute()
    {
        return collect([
            'phone' => $this->phone_number,
            'mobile' => $this->mobile_number,
            'email' => $this->email,
        ]);
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
        return (bool) $this->isActive() && $this->crews_count || $this->crews->count();
    }
 

    // Scopes

    public function scopeWhereIsCrewMember($query, $value)
    {
        return $query->where('is_crew_member', $value);
    }

    public function scopeOnlyIsCrewMember($query)
    {
        return $query->where('is_crew_member', true);
    }

    public function scopeOnlyIsNotCrewMember($query)
    {
        return $query->where('is_crew_member', false);
    }


    // Filters

    public function scopeFilterByStatus($query, $value)
    {
        if( is_null($value) ||! in_array($value, ['0', '1']) ) {
            return $query;
        }

        return $query->whereActive($value);
    }

    public function scopeFilterByIsCrewMember($query, $value)
    {
        if( is_null($value) ||! in_array($value, ['0', '1']) ) {
            return $query;
        }

        return $query->whereIsCrewMember($value);
    }

    public function scopeFilterBySortProp($query, $value, $way = null)
    {
        if( is_null($value) ||! in_array($value, ['name', 'last_name']) ) {
            return $query;
        }

        if( is_null($way) ||! in_array($way, ['asc', 'desc']) ) {
            return $query->orderByDesc($value);
        }

        return $query->orderBy($value, $way);
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
        return $this->morphMany(User::class, 'profile');
        // return $this->morphOne(User::class, 'profile');
    }
}
