<?php

namespace App\Models;

use App\Models\Kernel\AuthenticatedUserMetadataInterface;
use App\Models\Kernel\HasActionsByRequestTrait;
use App\Models\Kernel\HasAvailabilityTrait;
use App\Models\Kernel\HasBeforeAfterTrait;
use App\Models\Kernel\HasHookUsersTrait;
use App\Models\Kernel\HasModelHelpersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model implements AuthenticatedUserMetadataInterface
{
    use HasActionsByRequestTrait;
    use HasAvailabilityTrait;
    use HasBeforeAfterTrait;
    use HasFactory;
    use HasHookUsersTrait;
    use HasModelHelpersTrait;
    use SoftDeletes;

    public static $inputs_filters = [
        'status' => 'filterByStatus',
        'can_be_in_crews' => 'filterByCanBeInCrews',
        'sort_prop' => ['filterBySortProp', 'sort_prop_way'],
    ];

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
        'can_be_in_crews',
        'notes',
    ];

    protected $casts = [
        'birthdate' => 'date',
    ];



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

    public function getMetaNameAttribute(): string
    {
        return $this->full_name;
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

    public function canBeInCrews()
    {
        return (bool) $this->can_be_in_crews;
    }

    public function hasCrews()
    {
        return (bool) $this->isActive() && $this->crews_count || $this->crews->count();
    }
 


    // Scopes

    public function scopeWhereCanBeInCrews($query, $value)
    {
        return $query->where('can_be_in_crews', $value);
    }

    public function scopeOnlyCanBeInCrews($query)
    {
        return $query->where('can_be_in_crews', true);
    }

    public function scopeOnlyCannotBeInCrews($query)
    {
        return $query->where('can_be_in_crews', false);
    }



    // Filters

    public function scopeFilterByStatus($query, $value)
    {
        if( is_null($value) ||! in_array($value, ['0', '1']) ) {
            return $query;
        }

        return $query->whereActive($value);
    }

    public function scopeFilterByCanBeInCrews($query, $value)
    {
        if( is_null($value) ||! in_array($value, ['0', '1']) ) {
            return $query;
        }

        return $query->whereCanBeInCrews($value);
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
