<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'notes',
        'scheduled_date',
        'scheduled_time',
        'job_id',
        'client_id',
    ];


    // Attributes

    public function getScheduledDatetimeAttribute()
    {
        return sprintf('%s %s', $this->scheduled_date, $this->scheduled_time);
    }

    public function getScheduledDatetimeHumanAttribute()
    {
        return Carbon::parse( $this->scheduled_datetime )->toDayDateTimeString();
    }

    public function getScheduledDateHumanAttribute()
    {
        return Carbon::parse($this->scheduled_date)->format('D M d, Y');
    }

    public function getScheduledTimeHumanAttribute()
    {
        return Carbon::parse($this->scheduled_time)->format('h:i A');
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
}
