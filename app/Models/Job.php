<?php

namespace App\Models;

use App\Models\Job\InspectionsSetupWizard;
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
        'success_inspections_required_count',
        'inspections_setup_json',
        'is_active',
    ];

    private $inspections_setup_wizard_cache = null;


    // Mutators

    public function setInspectionsSetupJsonAttribute($value)
    {
        if( is_array($value) &&! empty($value) )
        {
            $this->attributes['inspections_setup_json'] = InspectionsSetupWizard::mapToJson($value);
        } 
        elseif( isJson($value) && $value <> '[]' )
        {
            $this->attributes['inspections_setup_json'] = $value;
        } 
        else 
        {
            $this->attributes['inspections_setup_json'] = null;
        }

        // Clear cache when this attribute is modified.
        $this->inspections_setup_wizard_cache = null;
    }


    // Accesors
    
    public function getInspectionsSetupAttribute()
    {
        if( is_null($this->inspections_setup_wizard_cache) ) {
            $this->inspections_setup_wizard_cache = new InspectionsSetupWizard($this->inspections_setup_json);
        }

        return $this->inspections_setup_wizard_cache;
    }

    public function getExtensionsCounterAttribute()
    {
        return ($this->extensions_count || $this->extensions->count());
    }


    // Validators

    public function requiresSuccessInspections(): bool
    {
        return (bool) $this->success_inspections_required_count;
    }

    public function hasInspectionsSetup(): bool
    {
        return ! empty($this->inspections_setup_json);
    }

    public function hasExtensions(): bool
    {
        return (bool) $this->extensions_counter;
    }


    // Actions

    public function down()
    {
        if( $this->trashed() ) {
            $this->update(['inspections_setup_json' => null]);
        }
    }


    // Relationships

    public function extensions()
    {
        return $this->belongsToMany(Extension::class);
    }


    // Statics

    public static function removeFromInspectionsSetup($key, $value)
    {
        $jobs = self::all();

        foreach($jobs as $job)
        {
            if( $job->inspections_setup->has($key, $value) )
            {
                $job->inspections_setup->remove($key, $value);
                $job->inspections_setup_json = $job->inspections_setup->all(true);
                $job->save();
            }
        }
    }
}
