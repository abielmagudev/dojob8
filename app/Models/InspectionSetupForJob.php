<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionSetupForJob extends Model
{
    use HasFactory;

    protected $table = 'inspection_setup_for_job';

    protected $fillable = [
        'options_json',
        'job_id',
    ];


    // Mutators

    public function setOptionsJsonAttribute($value)
    {
        $this->attributes['options_json'] = json_encode($value);
    }


    // Accessors

    public function getOptionsAttribute()
    {
        return json_decode($this->options_json);
    }

    public function getOptionsArrayAttribute()
    {
        return json_decode($this->options_json, true);
    }


    // Validators

    public function hasAgency(Agency $agency)
    {
        return property_exists($this->options, 'agency') && $this->options->agency == $agency->id;
    }
}
