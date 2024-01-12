<?php

namespace App\Models;

use App\Models\Kernel\HasExistenceTrait;
use App\Models\Kernel\HasHookUsersTrait;
use App\Models\Kernel\HasPresenceStatusTrait;
use App\Models\WorkOrder\HasWorkOrdersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasExistenceTrait;
    use HasFactory;
    use HasHookUsersTrait;
    use HasPresenceStatusTrait;
    use HasWorkOrdersTrait;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'preconfigured_required_inspections',
        'is_available',
    ];


    // Attributes

    public function getPreconfiguredRequiredInspectionsArrayAttribute()
    {
        if( is_null($this->preconfigured_required_inspections) ) {
            return array();
        }

        return json_decode($this->preconfigured_required_inspections); // (json_last_error() == JSON_ERROR_NONE)
    }

    public function getInspectionsRequiredCountAttribute()
    {
        return count($this->preconfigured_required_inspections_array);
    }

    
    // Validators
    
    public function hasExtensions(): bool
    {
        return (bool) ($this->extensions_count ?? $this->extensions->count());
    }

    public function requireInspections()
    {
        return (bool) count($this->preconfigured_required_inspections_array);
    }


    // Relationships

    public function extensions()
    {
        return $this->belongsToMany(Extension::class);
    }
}
