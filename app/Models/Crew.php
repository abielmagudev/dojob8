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

    public static $all_tasks = [
        'work order',
        'inspection',
    ];

    protected $fillable = [
        'name',
        'description',
        'tasks',
        'background_color',
        'text_color_mode',
        'is_active',
        'lead_member_id',
    ];



    // Attributes

    public function getTextColorAttribute()
    {
        return CrewPainter::getTextColorByMode( 
            $this->text_color_mode ?? CrewPainter::TEXT_COLOR_MODE_DEFAULT
        );
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

    public function getTasksArrayAttribute()
    {
        return ! is_null($this->tasks) ? json_decode( $this->tasks ) : [];
    }


    // Validators

    public function hasMembers()
    {
        return (bool) $this->isActive() && $this->members_count || $this->members->count();
    }

    public function hasTask(string $task)
    {
        return in_array($task, $this->tasks_array);
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

    public function scopeWhereTasks($query, string $task)
    {
        return $query->where('tasks', 'like', "%{$task}%");
    }

    public function scopeForInspectionTasks($query)
    {
        return $query->whereTasks('inspection');
    }

    public function scopeForWorkOrderTasks($query)
    {
        return $query->whereTasks('work order');
    }


    // Relationships

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class)->using(CrewMember::class);
    }


    // Static

    public static function getAllTasks()
    {
        return collect( self::$all_tasks );
    }
}
