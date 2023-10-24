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


    // Scopes

    public function scopeSearch($query, $value)
    {
        $query = $query->where('address', 'like', "%{$value}%");

        if( is_numeric($value) )
        {
            return $query->orWhere('zip_code', 'like', "%{$value}%")
                        ->orWhere('phone_number', 'like', "%{$value}%")
                        ->orWhere('mobile_number', 'like', "%{$value}%");
        }

        return $query->orWhere('name', 'like', "%{$value}%")
                    ->orWhere('lastname', 'like', "%{$value}%")
                    ->orWhere('email', 'like', "%{$value}%");
    }

    // Relations

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
