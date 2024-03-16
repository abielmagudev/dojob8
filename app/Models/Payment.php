<?php

namespace App\Models;

use App\Models\History\Traits\HasHistory;
use App\Models\Kernel\Interfaces\FilterableQueryStringContract;
use App\Models\Kernel\Traits\BelongsCreatorUser;
use App\Models\Kernel\Traits\BelongsUpdaterUser;
use App\Models\Kernel\Traits\HasFilterableQueryStringContract;
use App\Models\Kernel\Traits\HasStatus;
use App\Models\WorkOrder\Traits\BelongsWorkOrder;
use App\Models\WorkOrder\Traits\BelongsWorkOrders;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Payment extends Model implements FilterableQueryStringContract
{
    use BelongsCreatorUser;
    use BelongsUpdaterUser;
    use BelongsWorkOrder;
    use HasFactory;
    use HasFilterableQueryStringContract;
    use HasHistory;
    use HasStatus;
    use BelongsWorkOrders;

    const INITIAL_STATUS = 'unpaid';

    protected $fillable = [
        'status',
        'work_order_id',
    ];

    protected static $all_statuses = [
        'free',
        'paid',
        'unpaid',
    ];



    // Interface

    public function getMappingFilterableQueryString(): array
    {
        return [
            'dates' => 'filterByWorkOrderDates',
            'scheduled_date' => 'filterByWorkOrderScheduledDate',
            'status_group' => 'filterByStatusGroup',
        ];
    }


    
    // Relationships

    public function scopeWithEssentialRelationships($query)
    {
        return $query->with('work_order');
    }

    public function scopeWithNestedRelationships($query)
    {
        return $query->with([
            'work_order.client',
            'work_order.contractor',
            'work_order.job',
        ]);
    }



    // Scopes

    public function scopeFree($query)
    {
        return $query->where('status', 'free');
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopeUnpaid($query)
    {
        return $query->where('status', self::INITIAL_STATUS);
    }

    public function scopeUnpaidCount($query)
    {
        return $query->select( DB::raw('COUNT(*) as unpaid_count') )->where('status', self::INITIAL_STATUS);
    }


    // Statics

    public static function collectionAllStatuses()
    {
        return collect( self::$all_statuses );
    }
}
