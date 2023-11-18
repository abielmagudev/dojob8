<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Order extends Model
{
    use HasFactory;

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


    // Scopes

    public function scopeWhereJobsAvailable($query)
    {
        $jobs_id = Job::all('id')->pluck('id')->toArray();
        
        return $query->whereIn('job_id', $jobs_id);
    }

    public function scopeWherePrev($query, Request $request, Order $order)
    {
        return $query->where('id', '<', $order->id)->orderBy('id', 'desc');
    }

    public function scopeWhereNext($query, Request $request, Order $order)
    {
        return $query->where('id', '>', $order->id)->orderBy('id', 'asc');
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
