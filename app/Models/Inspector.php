<?php

namespace App\Models;

use App\Models\Kernel\HasBeforeAfterTrait;
use App\Models\Kernel\HasHookUsersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inspector extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasBeforeAfterTrait;
    use HasHookUsersTrait;

    protected $fillable = [
        'name',
        'notes',
    ];

    // Attributes

    public function getInspectionsOnHoldAttribute()
    {
        return $this->inspections->filter(fn($inspection) => $inspection->isOnHold());
    }

    public function getUrlPendingInspectionsAttribute()
    {
        $model = strtolower( class_basename(__CLASS__) );

        return Inspection::generatePendingInspectionsUrl([
            $model => $this->id,
        ]);
    }

    // Validators

    public function hasInspections()
    {
        return (bool) $this->inspections && $this->inspections->count();
    }

    public function hasInspectionsOnHold()
    {
        return (bool) $this->inspections_on_hold->count();
    }


    // Relationships

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }
}
