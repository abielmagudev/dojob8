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

    public function getOrderControllerAttribute()
    {
        return sprintf('%s\Controllers\%sOrderController', $this->namespace, $this->classname);
    }

    public function getViewsResourceAttribute()
    {
        return sprintf('%s/resources/views', $this->classname);
    }
    
    
    // Helpers

    public function bladeViewPath(string $view)
    {
        return sprintf('%s/%s', $this->views_resource, $view);
    }


    // Relations

    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }
}
