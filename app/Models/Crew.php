<?php

namespace App\Models;

use App\Models\Kernel\HasHookUsersTrait;
use App\Models\Kernel\HasPresenceStatusTrait;
use App\Models\WorkOrder\HasWorkOrdersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Crew extends Model
{
    use HasFactory;
    use HasHookUsersTrait;
    use HasPresenceStatusTrait;
    use HasWorkOrdersTrait;
    use SoftDeletes;

    const COLOR_HEX_PATTERN = '/^#[0-9A-Fa-f]{6}$/';

    const BACKGROUND_COLOR_DEFAULT = '#333333';

    const TEXT_COLOR_DEFAULT = '#DDDDDD';

    public static $all_tasks = [
        'work orders',
        'inspections',
    ];

    protected $fillable = [
        'name',
        'description',
        'tasks',
        'background_color_hex',
        'text_color_hex',
        'is_active',
        'lead_member_id',
    ];


    // Attributes

    public function getBackgroundColorAttribute()
    {
        return $this->background_color_hex ?? self::BACKGROUND_COLOR_DEFAULT;
    }

    public function getTextColorAttribute()
    {
        return $this->text_color_hex ?? self::TEXT_COLOR_DEFAULT;
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

    public function scopeWhereTasks($query, string $task)
    {
        return $query->where('tasks', 'like', "%{$task}%");
    }

    public function scopeForInspections($query)
    {
        return $query->whereTasks('inspections');
    }

    public function scopeForWorkOrders($query)
    {
        return $query->whereTasks('work orders');
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
