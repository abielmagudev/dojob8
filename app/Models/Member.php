<?php

namespace App\Models;

use App\Models\Kernel\AuthenticatedUserMetadataInterface;
use App\Models\Kernel\HasAvailabilityTrait;
use App\Models\Kernel\HasBeforeAfterTrait;
use App\Models\Kernel\HasHookUsersTrait;
use App\Models\Kernel\HasModelHelpersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model implements AuthenticatedUserMetadataInterface
{
    use HasAvailabilityTrait;
    use HasBeforeAfterTrait;
    use HasFactory;
    use HasHookUsersTrait;
    use HasModelHelpersTrait;
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
        'is_internal',
        'is_crew_member',
        'is_active',
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

    public function getInternalStatusAttribute()
    {
        return $this->isInternal() ? 'internal' : 'external';
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

    public function isInternal()
    {
        return (bool) $this->is_internal;
    }

    public function isExternal()
    {
        return ! (bool) $this->is_internal;
    }

    public function isCrewMember()
    {
        return (bool) $this->is_crew_member;
    }

    public function hasCrew()
    {
        return $this->crew_id && $this->crew;
    }

    

    // Relationships

    public function user()
    {
        return $this->morphOne(User::class, 'profile');
    }

    public function crew()
    {
        return $this->belongsTo(Crew::class);
    }

    

    // Scopes

    public function scopeOnlyCrewMember($query)
    {
        return $query->where('is_crew_member', 1);
    }

    public function scopeWhereIsCrewMember($query, $value)
    {
        return $query->where('is_crew_member', $value);
    }

    public function scopeWhereCrew($query, int $crew_id)
    {
        return $query->where('crew_id', $crew_id);
    }

    public function scopeUpdateCrew($query, $crew_id)
    {
        return $query->update(['crew_id' => $crew_id]);
    }
}
