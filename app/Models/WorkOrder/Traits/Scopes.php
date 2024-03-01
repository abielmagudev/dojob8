<?php 

namespace App\Models\WorkOrder\Traits;

trait Scopes
{
    public function scopeSearch($query, $value, string $column = 'id')
    {
        return $query->where($column, 'like', "%{$value}%")->orderBy('id','asc');
    }

    public function scopePending($query)
    {
        return $query->whereNull('scheduled_date')->orWhereNull('crew_id');
    }

    public function scopeNotPending($query)
    {
        return $query->whereNotNull('scheduled_date')->WhereNotNull('crew_id');
    }

    public function scopeIncomplete($query, array $except = [])
    {         
        $incomplete_statuses = self::collectionIncompleteStatuses()->reject(function($status) use ($except) {
            return in_array($status, $except);
        })->toArray();

        return $query->whereIn('status', $incomplete_statuses);
    }

    public function scopeHasMembers($query, array $members_id)
    {
        return $query->whereHas('members', function($query) use ($members_id){
            $query->whereIn('member_id', $members_id);
        });
    }

    public function scopeHasMember($query, $member_id)
    {
        return $query->whereHas('members', function($query) use ($member_id){
            $query->where('member_id', $member_id);
        });
    }

    public function scopeWithAllRelationships($query)
    {
        return $query->with([
            // Catalog
            'client',
            'contractor',
            'crew',
            'job',
            'done_updater',
            'working_updater',
            
            // Operative
            'comments',
            'inspections',
            'reworks',
            'warranties',

            // Morph
            'files',
            'history',
            
            // Pivot
            'members',
        ]);
    }

    public function scopeWithEssentialRelationships($query)
    {
        return $query->with([
            'client',
            'contractor',
            'crew',
            'job',
        ]);
    }
}
