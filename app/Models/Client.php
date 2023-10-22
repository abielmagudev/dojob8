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
        return implode(', ', [
            $this->city,
            $this->state,
            $this->country,
        ]);
    }


    // Relations

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
