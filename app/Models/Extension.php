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
        return sprintf('App\Apix\Stock\%s', $this->spacename);
    }
    
    public function getControllerAttribute()
    {
        return sprintf('%s\Controllers\ApixController', $this->namespace);
    }

    public function getWorkOrderControllerAttribute()
    {
        return sprintf('%s\Controllers\ApixWorkOrderController', $this->namespace);
    }


    // Relations

    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }
}
