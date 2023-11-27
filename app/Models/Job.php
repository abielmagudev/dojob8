<?php

namespace App\Models;

use App\Models\Kernel\HasAvailabilityTrait;
use App\Models\Kernel\HasBeforeAfterTrait;
use App\Models\Kernel\HasHookUsersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory;
    use HasAvailabilityTrait;
    use HasBeforeAfterTrait;
    use HasHookUsersTrait;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'approved_inspections_required',
        'is_available',
    ];


    
    // Validators
    
    public function hasExtensions(): bool
    {
        return (bool) ($this->extensions_count ?? $this->extensions->count());
    }



    // Relationships

    public function extensions()
    {
        return $this->belongsToMany(Extension::class);
    }

    public function work_orders()
    {
        return $this->hasMany(WorkOrder::class);
    }
}
