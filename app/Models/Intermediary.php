<?php

namespace App\Models;

use App\Helpers\CountryManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Intermediary extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'alias',
        'contact',
        'phone_number',
        'mobile_number',
        'email',
        'street',
        'zip_code',
        'country_code',
        'state_code',
        'city',
        'notes',
    ];

    public function setContactAttribute($value)
    {
        $this->attributes['contact'] = Str::title($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function getCountryAttribute()
    {
        if( is_null($this->country_code) ) {
            return null;
        }

        return CountryManager::get($this->country_code);
    }

    public function getCountryNameAttribute()
    {
        return $this->country ? $this->country->get('name') : null;
    }

    public function getStateNameAttribute()
    {
        return $this->country ? $this->country->get('states')->get($this->state_code) : null;
    }

    public function getLocationAttribute()
    {
        $data = array_filter([$this->city, $this->state_name, $this->country_name]);
        
        return implode(', ', $data);
    }

    public function getLocationCountryCodeAttribute()
    {
        $data = array_filter([$this->city, $this->state_name, $this->country_code]);
        
        return implode(', ', $data);
    }

    public function getAddressArrayAttribute()
    {
        return array_filter([$this->street, $this->location_country_code, $this->zip_code]);
    }

    public function hasInfo(string $prop)
    {
        return (bool) $this->$prop;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
