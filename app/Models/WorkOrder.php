<?php

namespace App\Models;

use App\Models\Kernel\HasBeforeAfterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkOrder extends Model
{
    use HasFactory;
    use HasBeforeAfterTrait;

    protected $fillable = [
        'client_id',
        'job_id',
        'notes',
        'scheduled_date',
        'scheduled_time',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];


    // Attributes

    public function getScheduledDateInputAttribute()
    {
        return $this->id ? $this->scheduled_date->format('Y-m-d') : null;
    }

    public function getScheduledDatetimeAttribute()
    {
        return sprintf('%s %s', $this->scheduled_date->format('Y-m-d'), $this->scheduled_time);
    }

    public function getScheduledDatetimeHumanAttribute()
    {
        return $this->id ? $this->scheduled_date->toDayDateTimeString() : null;
    }

    public function getScheduledDateHumanAttribute()
    {
        return $this->id ? $this->scheduled_date->format('D M d, Y') : null;
    }

    public function getScheduledTimeHumanAttribute()
    {
        return $this->id ? Carbon::parse($this->scheduled_time)->format('h:i A') : null;
    }

    public function getScheduledTimeWithoutMilisecondsAttribute()
    {
        return $this->id ? Carbon::parse($this->scheduled_time)->format('H:i') : null;
    }


    // Validators

    public function hasCrew()
    {
        return (bool) $this->crew_id && $this->crew;
    }



    // Scopes

    public function scopeWhereJobsAvailable($query)
    {
        $jobs_id = Job::all('id')->pluck('id')->toArray();
        
        return $query->whereIn('job_id', $jobs_id);
    }


    // Relations

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    public function crew()
    {
        return $this->belongsTo(Crew::class);
    }


    // Statics

    public static function getAllStatus()
    {
        return [
            'denialed',
            'completed',
            'pending',
            'canceled',
            'working',
            'done',
        ];
    }
}
