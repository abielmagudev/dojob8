<?php

namespace App\Models;

use App\Models\Client\Traits\BelongsClient;
use App\Models\Contractor\Traits\BelongsContractor;
use App\Models\History\Traits\HasHistory;
use App\Models\Kernel\Interfaces\FilterableQueryStringContract;
use App\Models\Kernel\Traits\HasFilterableQueryStringContract;
use App\Models\Kernel\Traits\HasScheduledDate;
use App\Models\Kernel\Traits\HasStatus;
use App\Models\WorkOrder\Traits\HasWorkOrders;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model implements FilterableQueryStringContract
{
    use HasFactory;
    
    use BelongsClient;
    use BelongsContractor;
    use HasFilterableQueryStringContract;
    use HasHistory;
    use HasScheduledDate;
    use HasStatus;
    use HasWorkOrders;

    protected $fillable = [
        'client_id',
        'contractor_id',
        'crew_id',
        'notes', 
        'ordered',
        'scheduled_date',
        'status',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];


    // Interface

    public function getMappingFilterableQueryString(): array
    {
        return [
            'client' => 'filterByClient',
            'contractor' => 'filterByContractor',
            'crew' => 'filterByCrew', 
            'dates' => 'filterByScheduledDateBetween',
            // 'pending' => 'filterByPending',
            'scheduled_date' => 'filterByScheduledDate',
            'status_group' => 'filterByStatusGroup',
            'status' => 'filterByStatus',
        ];
    }


    // Scopes

    public function scopeWithEssentialRelationships($query)
    {
        return $query->with([
            'client',
            'contractor',
        ]);
    }
}
