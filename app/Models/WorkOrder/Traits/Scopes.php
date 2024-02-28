<?php 

namespace App\Models\WorkOrder\Traits;

trait Scopes
{
    public function scopeSearch($query, $value, string $column = 'id')
    {
        return $query->where($column, 'like', "%{$value}%")->orderBy('id','asc');
    }

    public function scopeIncomplete($query, $attach_pending = true)
    {
        $statuses = self::getIncompleteStatuses();
         
        if(! $attach_pending ) {
            $statuses = $statuses->reject(fn($status) => $status == 'pending');
        }

        return $query->whereIn('status', $statuses->toArray());
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
            'client',
            'contractor',
            'crew',
            'job',
            'members',
            'reworks',
            'warranties',
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
