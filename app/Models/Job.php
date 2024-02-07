<?php

namespace App\Models;

use App\Models\Kernel\Traits\HasActiveStatus;
use App\Models\Kernel\Traits\HasHookUsers;
use App\Models\WorkOrder\Associated\HasWorkOrdersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasActiveStatus;
    use HasFactory;
    use HasHookUsers;
    use HasWorkOrdersTrait;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'successful_inspections_required',
        'preconfigured_required_inspections',
        'is_active',
    ];


    // Attributes

    public function getPreconfiguredRequiredInspectionsArrayAttribute()
    {
        if( is_null($this->preconfigured_required_inspections) ) {
            return array();
        }

        return json_decode($this->preconfigured_required_inspections); // (json_last_error() == JSON_ERROR_NONE)
    }

    public function getInspectorsPreconfiguredAttribute()
    {
        return $this->hasPreconfiguredRequiredInspections() 
            ? Agency::whereIn('id', $this->preconfigured_required_inspections_array)->get()
            : collect([]);
    }
    

    // Validators
    
    public function hasExtensions(): bool
    {
        return (bool) ($this->extensions_count ?? $this->extensions->count());
    }

    public function hasPreconfiguredRequiredInspections(): bool
    {
        return (bool) count($this->preconfigured_required_inspections_array);
    }

    public function requiresSuccessfulInspections()
    {
        return (bool) $this->successful_inspections_required;
    }


    // Relationships

    public function extensions()
    {
        return $this->belongsToMany(Extension::class);
    }
}
