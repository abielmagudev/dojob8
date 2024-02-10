<?php 

namespace App\Models\WorkOrder\Traits;

trait Scopes
{
    public function scopeSearch($query, $value, string $column = 'id')
    {
        return $query->where($column, 'like', "%{$value}%");
    }

    public function scopeIncomplete($query)
    {
        return $query->whereIn('status', self::getIncompleteStatuses()->toArray());
    }

    public function scopeWithRelationshipsForIndex($query)
    {
        return $query->with([
            'client',
            'contractor',
            'crew',
            'job',
        ]);
    }
}
