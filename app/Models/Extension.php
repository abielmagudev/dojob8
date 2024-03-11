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
        'spacename',
        'abbr',
    ];

    
    // Attributes

    public function getXapiNamespaceAttribute()
    {
        return sprintf('App\Xapis\Stock\%s', $this->spacename);
    }
    
    public function getXapiControllerAttribute()
    {
        return sprintf('%s\Controllers\%sController', $this->xapi_namespace, $this->spacename);
    }

    public function getXapiWorkOrderControllerAttribute()
    {
        return sprintf('%s\Controllers\%sWorkOrderController', $this->xapi_namespace, $this->spacename);
    }


    // Actions

    public function appXapiController()
    {
        return app($this->xapi_controller);
    }

    public function appXapiWorkOrderController()
    {
        return app($this->xapi_work_order_controller);
    }


    // Relationships

    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }
}
