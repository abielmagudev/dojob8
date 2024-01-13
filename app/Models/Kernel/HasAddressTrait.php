<?php 

namespace App\Models\Kernel;

use Illuminate\Support\Str;

trait HasAddressTrait
{
    use HasCountryStateCodesTrait;


    // Mutators

    public function setStreetAttribute($value)
    {
        $this->attributes['street'] = Str::title($value);
    }

    public function setCityNameAttribute($value)
    {
        $this->attributes['city_name'] = Str::title($value);
    }


    // Attributes

    public function getAddressDataAttribute()
    {
        return collect([
            'street' => $this->street,
            'city_name' => $this->city_name,
            'zip_code' => $this->zip_code,
            'district_code' => $this->district_code,   
        ])
        ->merge( $this->country_state_data->toArray() );
    }

    public function getAddressCodesAttribute()
    {
        return $this->address_data->only([
            'street',
            'city_name',
            'state_code',
            'country_code',
            'zip_code',
            'district_code',
        ]);
    }

    public function getAddressNamesAttribute()
    {
        return $this->address_data->only([
            'street',
            'city_name',
            'state_name',
            'country_name',
            'zip_code',
            'district_code',
        ]);
    }
}
