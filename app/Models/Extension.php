<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Extension extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'namespace',
        'classname',
    ];
    
    public function getControllerAttribute()
    {
        return sprintf('%s\Controllers\%sController', $this->namespace, $this->classname);
    }

    public function getOrderControllerAttribute()
    {
        return sprintf('%s\Controllers\%sOrderController', $this->namespace, $this->classname);
    }

    public function formRequestClassname(string $form_request)
    {
        return sprintf('%s\Requests\%s', $this->namespace, $form_request);
    }


    // Relations

    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }
}
