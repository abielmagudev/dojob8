<?php

namespace App\Models;

use App\Models\Kernel\HasHookUsersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inspector extends Model
{
    use HasFactory;
    use HasHookUsersTrait;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'notes',
        'is_active',
    ];

    
    // Attributes

    public function getPendingInspectionsAttribute()
    {
        return $this->inspections->filter(fn($inspection) => $inspection->isStatus('pending'));
    }

    public function getOnHoldInspectionsAttribute()
    {
        return $this->inspections->filter(fn($inspection) => $inspection->isStatus('on hold'));
    }

    public function getPendingAndOnHoldInspectionsAttribute()
    {
        return $this->pending_inspections->merge(
            $this->on_hold_inspections
        );
    }


    // Validators

    public function hasInspections()
    {
        return (bool) $this->inspections && $this->inspections->count();
    }

    public function hasPendingInspections()
    {
        return (bool) $this->pending_inspections->count();
    }

    public function hasOnHoldInspections()
    {
        return (bool) $this->on_hold_inspections->count();
    }

    public function hasPendingOrOnHoldInspections()
    {
        return $this->hasPendingInspections() || $this->hasOnHoldInspections();
    }

    public function hasNotes()
    {
        return ! is_null($this->notes);
    }

    
    // Relationships

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }
}
