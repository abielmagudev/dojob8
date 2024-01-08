<?php

namespace App\Models;

use App\Models\Kernel\HasHookUsersTrait;
use App\Models\Kernel\HasModelHelpersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inspector extends Model
{
    use HasFactory;
    use HasHookUsersTrait;
    use HasModelHelpersTrait;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'notes',
    ];


    
    // Attributes

    public function getInspectionsOnHoldAttribute()
    {
        return $this->inspections->filter(fn($inspection) => $inspection->hasStatus('on hold'));
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
