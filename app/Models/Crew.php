<?php

namespace App\Models;

use App\Models\History\Traits\HasHistory;
use App\Models\Inspection\Traits\HasInspections;
use App\Models\Kernel\Traits\BelongsCreatorUser;
use App\Models\Kernel\Traits\BelongsDeleterUser;
use App\Models\Kernel\Traits\BelongsUpdaterUser;
use App\Models\Kernel\Traits\HasActiveStatus;
use App\Models\WorkOrder\Traits\HasWorkOrders;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Crew extends Model
{
    use BelongsCreatorUser;
    use BelongsDeleterUser;
    use BelongsUpdaterUser;
    use HasActiveStatus;
    use HasFactory;
    use HasHistory;
    use HasInspections;
    use HasWorkOrders;
    use SoftDeletes;

    const COLOR_HEX_PATTERN = '/^#[0-9A-Fa-f]{6}$/';

    const BACKGROUND_COLOR_DEFAULT = '#333333';

    const TEXT_COLOR_DEFAULT = '#DDDDDD';

    protected $fillable = [
        'name',
        'description',
        'colors_json',
        'lead_member_id',
        'is_active',
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

    public function hasMembers()
    {
        return (bool) ($this->members_count ?? $this->members->count());
    }

    public function hasTasks()
    {
        return (bool) ($this->tasks_count ?? $this->tasks->count());
    }

    public function hasTask(Task $task)
    {
        return $this->tasks->contains($task);
    }

    public function hasTaskByName(string $value)
    {
        return $this->tasks->contains(function($task) use ($value) {
            $task->name == $value;
        });
    }


    // Relationships

    public function members()
    {
        return $this->belongsToMany(Member::class)->using(CrewMember::class)->withTimestamps();
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }


    // Scopes

    public function scopeTask($query, $values)
    {
        if(! is_array($values) ) {
            $values = [$values];
        }

        return $query->whereHas('tasks', function ($q) use ($values) {
            $q->whereIn('name', $values);
        });
    }
}
