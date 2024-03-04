<?php

namespace App\Models;

use App\Models\Inspection\Traits\HasInspections;
use App\Models\Kernel\Traits\HasActiveStatus;
use App\Models\Kernel\Traits\HasHookUsers;
use App\Models\WorkOrder\Associated\HasWorkOrdersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Crew extends Model
{
    use HasActiveStatus;
    use HasFactory;
    use HasHookUsers;
    use HasWorkOrdersTrait;
    use HasInspections;
    use SoftDeletes;

    const COLOR_HEX_PATTERN = '/^#[0-9A-Fa-f]{6}$/';

    const BACKGROUND_COLOR_DEFAULT = '#333333';

    const TEXT_COLOR_DEFAULT = '#DDDDDD';

    protected $fillable = [
        'name',
        'description',
        'colors_json',
        'purposes_stringify',
        'lead_member_id',
        'is_active',
    ];

    protected static $all_purposes = [
        // 'assessments',
        'inspections',
        'work orders',
    ];



    // Mutators

    public function setColorsJsonAttribute($values)
    {
        if(! is_array($values) )
        {
            $this->attributes['colors_json'] = json_encode([
                'background' => self::BACKGROUND_COLOR_DEFAULT,
                'text' => self::TEXT_COLOR_DEFAULT,
            ]);
            
            return;
        }

        $this->attributes['colors_json'] = json_encode([
            'background' => $values[0],
            'text' => $values[1],
        ]);
    }

    public function setPurposesStringifyAttribute($values)
    {
        if(! is_array($values) || is_array($values) && empty($values) ) {
            $this->attributes['purposes_stringify'] = null;
            return;
        }

        $this->attributes['purposes_stringify'] = implode(',', $values);
    }



    // Accessors

    public function getColorsAttribute()
    {
        return json_decode($this->colors_json);
    }

    public function getColorsArrayAttribute()
    {
        return json_decode($this->colors_json, true);
    }

    public function getBackgroundColorAttribute()
    {
        return $this->hasBackgroundColor() ? $this->colors->background : self::BACKGROUND_COLOR_DEFAULT;
    }

    public function getTextColorAttribute()
    {
        return $this->hasTextColor() ? $this->colors->text : self::TEXT_COLOR_DEFAULT;
    }

    public function getPurposesArrayAttribute()
    {
        return ! empty($this->purposes_stringify) ? explode(',', $this->purposes_stringify) : [];
    }



    // Relationships

    public function members()
    {
        return $this->belongsToMany(Member::class)->using(CrewMember::class)->withTimestamps();
    }



    // Validators

    public function hasDescription()
    {
        return ! empty($this->description);
    }

    public function hasColors()
    {
        return ! empty($this->colors_json) && isJson($this->colors_json);
    }

    public function hasBackgroundColor()
    {
        return $this->hasColors() && property_exists($this->colors, 'background');
    }

    public function hasTextColor()
    {
        return $this->hasColors() && property_exists($this->colors, 'text');
    }

    public function hasPurposes()
    {
        return ! empty($this->purposes_array);
    }

    public function hasPurpose($purpose)
    {
        return in_array($purpose, $this->purposes_array);
    }

    public function hasMembers()
    {
        return (bool) $this->members_count || $this->members->count();
    }



    // Scopes

    public function scopePurposeAssessments($query)
    {
        return $query->where('purposes_stringify', 'like', '%assessments%');
    }

    public function scopePurposeInspections($query)
    {
        return $query->where('purposes_stringify', 'like', '%inspections%');
    }

    public function scopePurposeWorkOrders($query)
    {
        return $query->where('purposes_stringify', 'like', '%work orders%');
    }



    // Statics

    public static function collectionAllPurposes()
    {
        return collect( self::$all_purposes );
    }
}
