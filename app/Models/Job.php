<?php

namespace App\Models;

use App\Models\Job\InspectionsSetupWizard;
use App\Models\Kernel\Traits\HasActiveStatus;
use App\Models\Kernel\Traits\HasHookUsers;
use App\Models\WorkOrder\Traits\HasWorkOrders;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasActiveStatus;
    use HasFactory;
    use HasHookUsers;
    use HasWorkOrders;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'success_inspections_required_count',
        'is_active',
    ];


    // Accesors

    public function getInspectionSetupCounterAttribute()
    {
        return ($this->inspection_setup_count || $this->inspection_setup->count());
    }

    public function getExtensionsCounterAttribute()
    {
        return ($this->extensions_count || $this->extensions->count());
    }


    // Relationships

    public function inspection_setup()
    {
        return $this->hasMany(InspectionSetupForJob::class);
    }

    public function extensions()
    {
        return $this->belongsToMany(Extension::class);
    }


    // Validators

    public function requiresSuccessInspections(): bool
    {
        return (bool) $this->success_inspections_required_count;
    }

    public function hasInspectionSetup(): bool
    {
        return (bool) $this->inspection_setup_counter;
    }

    public function hasExtensions(): bool
    {
        return (bool) $this->extensions_counter;
    }
}
