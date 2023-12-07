<?php

namespace App\Models;

use App\Models\Crew\CrewPainter;
use App\Models\Kernel\HasAvailabilityTrait;
use App\Models\Kernel\HasBeforeAfterTrait;
use App\Models\Kernel\HasHookUsersTrait;
use App\Models\Kernel\HasModelHelpersTrait;
use App\Models\WorkOrder\HasWorkOrdersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Crew extends Model
{
    use HasAvailabilityTrait;
    use HasBeforeAfterTrait;
    use HasFactory;
    use HasHookUsersTrait;
    use HasModelHelpersTrait;
    use HasWorkOrdersTrait;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'background_color',
        'text_color_mode',
        'is_active',
        'lead_member_id',
    ];



    // Attributes

    public function getTextColorAttribute()
    {
        return $this->id ? CrewPainter::getTextColorByMode( $this->text_color_mode ) : CrewPainter::getTextColorByMode( CrewPainter::TEXT_COLOR_MODE_DEFAULT );
    }

    public function getDatasetAttribute()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'members' => $this->members->map(function ($member) {
                return [
                    'id' => $member->id,
                    'full_name' => $member->full_name,
                ];
            })
        ];
    }

    public function getDatasetJsonAttribute()
    {
        return json_encode( $this->dataset );
    }


    // Validators

    public function hasMembers()
    {
        return (bool) $this->isActive() && ($this->members_count ?? $this->loadCount('members'));
    }


    // Actions

    public function addMembers(array $members_id)
    {
        return Member::whereIn('id', $members_id)->updateCrew($this->id);
    }

    public function removeMembers()
    {
        return Member::whereCrew($this->id)->updateCrew(null);
    }


    // Scopes

    public function scopeWhereActive($query, $value)
    {
        return $query->where('is_active', $value);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', 0);
    }


    // Relationships

    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
