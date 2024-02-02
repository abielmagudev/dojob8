<?php

namespace App\Models;

use App\Models\Kernel\HasHookUsersTrait;
use App\Models\Kernel\HasPresenceStatusTrait;
use App\Models\WorkOrder\Associated\HasWorkOrdersTrait;
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

    const BACKGROUND_COLOR_INACTIVE = '#777777';

    const TEXT_COLOR_DEFAULT = '#DDDDDD';

    public static $all_tasks = [
        'inspections',
        'work orders',
    ];

    protected $fillable = [
        'name',
        'description',
        'tasks_json',
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

    public function getBackgroundColorInactiveAttribute()
    {
        return self::BACKGROUND_COLOR_INACTIVE;
    }

    public function getTextColorAttribute()
    {
        return $this->text_color_hex ?? self::TEXT_COLOR_DEFAULT;
    }

    public function getTasksArrayAttribute()
    {
        return ! empty($this->tasks_json) ? json_decode($this->tasks_json) : [];
    }


    // Validators

    public function hasDescription()
    {
        return ! empty($this->description);
    }

    public function hasMembers()
    {
        return (bool) $this->isActive() && $this->members_count || $this->members->count();
    }

    public function hasTask(string $task)
    {
        return in_array($task, $this->tasks_array);
    }


    // Scopes

    public function scopeTasksLike($query, string $task)
    {
        return $query->where('tasks_json', 'like', "%{$task}%");
    }

    public function scopeTaskInspections($query)
    {
        return $query->tasksLike('inspections');
    }

    public function scopetaskWorkOrders($query)
    {
        return $query->tasksLike('work orders');
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

    public static function allTasks()
    {
        return collect( self::$all_tasks );
    }
}
