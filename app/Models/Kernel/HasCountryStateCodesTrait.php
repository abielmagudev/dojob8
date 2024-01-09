<?php 

namespace App\Models\Kernel;

use App\Suppliers\CountryManager;

trait HasCountryStateCodesTrait
{
    public function getCountryAttribute()
    {
        return ! is_null($this->country_code) ? CountryManager::get($this->country_code) : null;
    }

    public function getCountryNameAttribute()
    {
        return $this->country ? $this->country->get('name') : null;
    }

    public function getCountryStatesAttribute()
    {
        return $this->country ? $this->country->get('states') : null;
    }

    public function getStateNameAttribute()
    {
        return $this->country ? $this->country_states->get($this->state_code) : null;
    }

    public function getCountryStateDataAttribute()
    {
        return collect([
            'state_code' => $this->state_code,
            'state_name' => $this->state_name,
            'country_code' => $this->country_code,
            'country_name' => $this->country_name,
        ]);
    }
}
