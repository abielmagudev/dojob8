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
            'mobile' => $this->mobile_number,
            'phone' => $this->phone_number,
            'email' => $this->email,
        ]);
    }
}
