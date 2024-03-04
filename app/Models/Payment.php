<?php

namespace App\Models;

use App\Models\Kernel\Interfaces\Filterable;
use App\Models\Kernel\Traits\HasFiltering;
use App\Models\Kernel\Traits\HasStatus;
use App\Models\WorkOrder\Traits\BelongWorkOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Payment extends Model implements Filterable
{
    use HasFactory;
    use HasFiltering;
    use HasStatus;
    use BelongWorkOrder;

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

    public function getParameterFilterSettings(): array
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
