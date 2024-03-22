<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobInspectionSetup extends Model
{
    use HasFactory;

    protected $table = 'job_inspection_setup';

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
