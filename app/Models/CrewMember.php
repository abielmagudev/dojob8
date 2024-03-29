<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CrewMember extends Pivot
{
    use HasFactory;

    // const UPDATED_AT = null;


    // Scopes

    public function scopeRemoveCrewsExcept($query, array $values)
    {
        return $query->whereNotIn('crew_id', $values)->delete();
    }


    // Hooks

    /*
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = now();
        });
    }
    */
}
