<?php

namespace App\Models;

use App\Models\Kernel\AuthenticatedUserMetadataInterface;
use App\Models\Kernel\HasAvailabilityTrait;
use App\Models\Kernel\HasBeforeAfterTrait;
use App\Models\Kernel\HasHookUsersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model implements AuthenticatedUserMetadataInterface
{
    use HasFactory;
    use SoftDeletes;
    use HasAvailabilityTrait;
    use HasBeforeAfterTrait;
    use HasHookUsersTrait;

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
        'scope',
        'is_active',
        'notes',
    ];

    protected $casts = [
        'birthdate' => 'date',
    ];

    public static $categories_descriptions = [
        'administrative' => 'Administrative description',
        'operative' => 'Operative description',
    ];

    public static $scopes_descriptions = [
        'external' => 'External description',
        'internal' => 'Internal description',
    ];



    // Attributes

    public function getBirthdateInputAttribute()
    {
        return $this->birthdate ? $this->birthdate->format('Y-m-d') : null;
    }

    public function getBirthdateHumanAttribute()
    {
        return $this->birthdate ? $this->birthdate->format('d M, Y') : null;
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

    public function isHappyBirthday()
    {
        return $this->birthdate->isBirthday();
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

    public function scopeWhereCategory($query, $value)
    {
        return $query->where('category', $value);
    }

    public function scopeAdministrative($query)
    {
        return $query->whereCategory('administrative');
    }

    public function scopeOperative($query)
    {
        return $query->whereCategory('operative');
    }

    public function scopeWhereCrew($query, int $crew_id)
    {
        return $query->where('crew_id', $crew_id);
    }

    public function scopeUpdateCrew($query, $crew_id)
    {
        return $query->update(['crew_id' => $crew_id]);
    }



    // Statics
    
    public static function getScopes()
    {
        return array_keys(self::$scopes_descriptions);
    }

    public static function getScopesDescriptions()
    {
        return self::$scopes_descriptions;
    }

    public static function getCategories()
    {
        return array_keys(self::$categories_descriptions);
    }

    public static function getCategoriesDescriptions()
    {
        return self::$categories_descriptions;
    }
}
