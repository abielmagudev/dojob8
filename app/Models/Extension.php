<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Extension extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'classname',
    ];

    
    // Attributes

    public function getNamespaceAttribute()
    {
        return sprintf('App\Apix\%s', $this->classname);
    }
    
    public function getControllerAttribute()
    {
        return sprintf('%s\Controllers\%sController', $this->namespace, $this->classname);
    }

    public function getWorkOrderControllerAttribute()
    {
        return sprintf('%s\Controllers\%sWorkOrderController', $this->namespace, $this->classname);
    }


    // Relations

    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }
}
