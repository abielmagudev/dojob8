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

    public function getXapiNamespaceAttribute()
    {
        return sprintf('App\Xapis\Stock\%s', $this->spacename);
    }
    
    public function getXapiControllerAttribute()
    {
        return sprintf('%s\Controllers\XapiController', $this->xapi_namespace);
    }

    public function getXapiWorkOrderControllerAttribute()
    {
        return sprintf('%s\Controllers\XapiWorkOrderController', $this->xapi_namespace);
    }


    // Relations

    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }
}
