<?php

namespace App\Models\WorkOrder\Traits;

use App\Models\Client;
use App\Models\Comment;
use App\Models\Contractor;
use App\Models\Crew;
use App\Models\File;
use App\Models\History;
use App\Models\Inspection;
use App\Models\Job;
use App\Models\Member;
use App\Models\MemberWorkOrder;

trait Relationships
{
    public function reworks()
    {
        return $this->hasMany(self::class, 'rework_id');
    }

    public function warranties()
    {
        return $this->hasMany(self::class, 'warranty_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function crew()
    {
        return $this->belongsTo(Crew::class);
    }

    public function contractor()
    {
        return $this->belongsTo(Contractor::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class)->using(MemberWorkOrder::class)->withTimestamps();
    }

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function history()
    {
        return $this->morphMany(History::class, 'model');
    }
}
