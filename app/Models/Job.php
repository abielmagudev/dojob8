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
        'is_active',
        'name',
        'description',
        'approved_inspections_required_count',
        'agencies_generate_inspections_json',
    ];


    // Attributes

    public function getAgenciesGenerateInspectionsArrayAttribute()
    {
        if( is_null($this->agencies_generate_inspections_json) ) {
            return array();
        }

        return json_decode($this->agencies_generate_inspections_json); // (json_last_error() == JSON_ERROR_NONE)
    }
    

    // Validators
    
    public function hasExtensions(): bool
    {
        return (bool) $this->extensions_count || $this->extensions->count();
    }

    public function requiresApprovedInspections(): bool
    {
        return (bool) $this->approved_inspections_required_count;
    }

    public function hasAgenciesToGenerateInspections(): bool
    {
        return (bool) count($this->agencies_generate_inspections_array);
    }

    public function hasAgencyToGenerateInspections($agency_id): bool
    {
        return in_array($agency_id, $this->agencies_generate_inspections_array);
    }


    // Actions

    public function agenciesToGenerateInspections()
    {
        return Agency::whereIn('id', $this->agencies_generate_inspections_array)->get();
    }


    // Relationships

    public function extensions()
    {
        return $this->belongsToMany(Extension::class);
    }
}
