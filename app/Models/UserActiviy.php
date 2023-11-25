<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActiviy extends Model
{
    protected $table = 'user_activities';

    protected $fillable = [
        'description',
        'device',
        'user_id'
    ];

    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }
}
