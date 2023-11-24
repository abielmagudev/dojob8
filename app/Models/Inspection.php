<?php

namespace App\Models;

use App\Models\Kernel\HasBeforeAfterTrait;
use App\Models\Kernel\HasModifiersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    use HasFactory;
    use HasBeforeAfterTrait;
    use HasModifiersTrait;

    protected $fillable = [
        'scheduled_date',
        'observations',
        'notes',
        'is_approved',
        'inspector_id',
        'order_id',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];

    public static $all_status = [
        null => 'hold on',
        0 => 'failed',
        1 => 'approved',
    ];

    public function getStatusAttribute()
    {
        return $this->is_approved;
    }

    public function getStatusLabelAttribute()
    {
        if( $this->isHoldOn() ) {
            return 'hold on';
        }

        if( $this->isFailed() ) {
            return 'failed';
        }

        return 'approved';
    }

    public function getStatusColorAttribute()
    {
        if( $this->isHoldOn() ) {
            return 'secondary';
        }

        if( $this->isFailed() ) {
            return 'danger';
        }

        return 'success';
    }

    public function isHoldOn()
    {
        return is_null($this->status);
    }

    public function isApproved()
    {
        return $this->status == 1;
    }

    public function isFailed()
    {
        return $this->status == 0;
    }

    public function hasObservations()
    {
        return ! empty($this->observations);
    }

    public function hasNotes()
    {
        return $this->notes <> null;
    }


    public function inspector()
    {
        return $this->belongsTo(Inspector::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }


    public static function getAllStatus()
    {
        return self::$all_status;
    }
}
