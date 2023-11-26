<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'histories';

    protected $fillable = [
        'description',
        'link',
        'model_type',
        'model_id',
        'user_id',
    ];

    public $timestamps = false;
    


    // Validators

    public function hasLink()
    {
        return ! empty($this->link);
    }



    // Scopes

    public function scopeWhereModel($query, $classname, $id)
    {
        return $query->where('model_type', $classname)->where('model_id', $id);
    }

    public function scopeWhereNotModel($query, $classname, $id)
    {
        return $query->where('model_type', '<>', $classname)->where('model_id', '<>', $id);
    }

    public function scopeWhereUser($query, $id)
    {
        return $query->where('user_id', $id);
    }

    public function scopeWhereNotUser($query, $id)
    {
        return $query->where('user_id', '<>', $id);
    }

    public function scopeHasLink($query)
    {
        return $query->whereNotNull('link');
    }

    public function scopeNotHasLink($query)
    {
        return $query->whereNull('link');
    }



    // Relationships

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function model()
    {
        return $this->morphTo(__FUNCTION__, 'model_type', 'model_id');
    }


    
    // Hooks

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }
}
