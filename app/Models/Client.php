<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'address',
        'zip_code',
        'city',
        'state',
        'country',
        'phone_number',
        'mobile_number',
        'email',
        'notes',
    ];


    // Attributes 

    public function getFullnameAttribute()
    {
        return sprintf('%s %s', $this->name, $this->lastname);
    }

    public function getLocationAttribute()
    {
        $segments = array_filter([
            $this->city,
            $this->state,
            $this->country,
        ]);

        return implode(', ', $segments);
    }

    public function getContactAttribute()
    {
        $segments = array_filter([
            $this->phone_number,
            $this->mobile_number,
            $this->email,
        ]);
        
        return implode(', ', $segments);
    }


    // Relations

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
