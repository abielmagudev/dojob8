<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CrewMember extends Pivot
{
    use HasFactory;

    const UPDATED_AT = null;

    
    // Scopes

    public function scopeCrew($query, $value)
    {
        return $query->where('crew_id', $value);
    }

    public function scopeCrewIn($query, array $values)
    {
        return $query->whereIn('crew_id', $values);
    }

    public function scopeCrewNotIn($query, array $values)
    {
        return $query->whereNotIn('crew_id', $values);
    }

    public function scopeMember($query, $value)
    {
        return $query->where('member_id', $value);
    }

    public function scopeMemberIn($query, array $values)
    {
        return $query->whereIn('member_id', $values);
    }

    public function scopeMemberNotIn($query, array $values)
    {
        return $query->whereNotIn('member_id', $values);
    }


    // Hooks

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = now();
        });
    }
}
