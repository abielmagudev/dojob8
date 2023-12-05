<?php 

namespace App\Models\Kernel;

use App\Suppliers\CountryManager;

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

    public function getLocationDataCollectionAttribute()
    {
        return collect([
            'city_name' => $this->city,
            'state_code' => $this->state_code,
            'state_name' => $this->state_name,
            'country_code' => $this->country_code,
            'coutnry_name' => $this->country_name,
        ]);
    }

    public function getLocationAttribute()
    {
        return $this->location_data_collection->only([
            'city_name',
            'state_name',
            'country_name',
        ]);
    }
    
    public function getLocationCodesAttribute()
    {
        return $this->location_data_collection->only([
            'city_name',
            'state_code',
            'country_code',
        ]);
    }

    public function getLocationCountryCodeAttribute()
    {
        return $this->location_data_collection->only([
            'city_name',
            'state_name',
            'country_code',
        ]);
    }

    public function getLocationWithoutCountryAttribute()
    {
        return $this->location_data_collection->only([
            'city_name',
            'state_name',
        ]);
    }

    public function getLocationStateCodeAttribute()
    {
        return $this->location_data_collection->only([
            'city_name',
            'state_code',
        ]);
    }

    public function locationDataImplode(string $glue, string $attribute = 'location')
    {
        return $this->$attribute->filter()->implode($glue);
    }
}
