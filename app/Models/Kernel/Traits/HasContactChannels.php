<?php 

namespace App\Models\Kernel\Traits;

trait HasContactChannels
{
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }
    
    public function getContactDataAttribute()
    {
        return collect([
            'phone' => $this->phone_number,
            'mobile' => $this->mobile_number,
            'email' => $this->email,
        ]);
    }
}
