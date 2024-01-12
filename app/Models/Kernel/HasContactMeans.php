<?php 

namespace App\Models\Kernel;

trait HasContactMeans
{
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }
    
    public function getContactDataAttribute()
    {
        return collect([
            'phone number' => $this->phone_number,
            'mobile number' => $this->mobile_number,
            'email' => $this->email,
        ]);
    }
}
