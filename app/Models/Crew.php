<?php

namespace App\Models;

use App\Models\Kernel\HasAvailabilityTrait;
use App\Models\Kernel\HasBeforeAfterTrait;
use App\Models\Kernel\HasHookUsersTrait;
use App\Models\WorkOrder\HasWorkOrdersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Crew extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasAvailabilityTrait;
    use HasBeforeAfterTrait;
    use HasHookUsersTrait;
    use HasWorkOrdersTrait;

    protected $fillable = [
        'name',
        'description',
        'color',
        'is_active',
    ];



    // Validators

    public function hasColor()
    {
        return $this->color <> null;
    }

    public function hasMembers()
    {
        return (bool) $this->isActive() && $this->loadCount('members');
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



    // Relationships

    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
