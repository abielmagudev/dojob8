<?php 

namespace App\Models\Kernel;

use App\Helpers\CountryManager;

trait HasCountryStateCodesTrait
{
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
        $data = array_filter([
            $this->city,
            $this->state_name,
            $this->country_name
        ]);
        
        return implode(', ', $data);
    }
    
    public function getLocationCountryCodeAttribute()
    {
        $data = array_filter([
            $this->city,
            $this->state_name,
            $this->country_code
        ]);
        
        return implode(', ', $data);
    }

    public function getLocationWithoutCountryAttribute()
    {
        $data = array_filter([
            $this->city,
            $this->state_name
        ]);
        
        return implode(', ', $data);
    }
}
