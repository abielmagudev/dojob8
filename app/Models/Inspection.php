<?php

namespace App\Models;

use App\Models\Kernel\HasBeforeAfterTrait;
use App\Models\Kernel\HasHookUsersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    use HasFactory;
    use HasBeforeAfterTrait;
    use HasHookUsersTrait;

    protected $fillable = [
        'scheduled_date',
        'observations',
        'notes',
        'is_approved',
        'inspector_id',
        'work_order_id',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];

    public static $all_status = [
        null => 'hold on',
        0 => 'failed',
        1 => 'approved',
    ];



    // Attributes

    public function getApprovedColorAttribute()
    {
        if( $this->isHoldOn() ) {
            return 'secondary';
        }

        if( $this->isFailed() ) {
            return 'danger';
        }

        return 'success';
    }

    public function getApprovedStatusAttribute()
    {
        if( $this->isHoldOn() ) {
            return 'hold on';
        }

        if( $this->isFailed() ) {
            return 'failed';
        }

        return 'approved';
    }



    // Validations

    public function isHoldOn()
    {
        return is_null($this->is_approved);
    }

    public function isApproved()
    {
        return $this->is_approved == 1;
    }

    public function isFailed()
    {
        return $this->is_approved == 0;
    }

    public function hasObservations()
    {
        return ! empty($this->observations);
    }

    public function hasNotes()
    {
        return $this->notes <> null;
    }



    // Relationships

    public function inspector()
    {
        return $this->belongsTo(Inspector::class);
    }

    public function work_order()
    {
        return $this->belongsTo(WorkOrder::class);
    }



    // Statics

    public static function getAllStatus()
    {
        return self::$all_status;
    }
}
