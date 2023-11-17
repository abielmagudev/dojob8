<?php

namespace App\Models;

use App\Models\Kernel\HasCountryStateCodesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    use HasCountryStateCodesTrait;

    protected $fillable = [
        'name',
        'lastname',
        'fullname',
        'street',
        'zip_code',
        'country_code',
        'state_code',
        'city',
        'phone_number',
        'mobile_number',
        'email',
        'notes',
    ];


    // Attributes 

    public function getContactInfoCollectionAttribute()
    {
        return collect([
            'phone'  => $this->phone_number,
            'mobile' => $this->mobile_number,
            'email'  => $this->email,
        ]);
    }


    // Scopes

    public function scopeSearch($query, $value)
    {
        return $query->where('fullname', 'like', "%{$value}%")
                    ->orWhere('phone_number', 'like', "%{$value}%")
                    ->orWhere('mobile_number', 'like', "%{$value}%")
                    ->orWhere('email', 'like', "%{$value}%")
                    ->orWhere('street', 'like', "%{$value}%")
                    ->orWhere('zip_code', 'like', "%{$value}%")
                    ->orWhere('city', 'like', "%{$value}%");
    }

    // Relations

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
