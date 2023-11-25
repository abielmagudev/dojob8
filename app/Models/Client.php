<?php

namespace App\Models;

use App\Models\Kernel\HasBeforeAfterTrait;
use App\Models\Kernel\HasCountryStateCodesTrait;
use App\Models\Kernel\HasHookUsersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasBeforeAfterTrait;
    use HasCountryStateCodesTrait;
    use HasHookUsersTrait;

    protected $fillable = [
        'name',
        'last_name',
        'full_name',
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

    public function getAddressAttribute()
    {
        $data = [
            $this->street,
            $this->location_country_code,
            $this->zip_code,
        ];

        return implode(', ', $data);
    }


    // Scopes

    public function scopeSearch($query, $value)
    {
        return $query->where('full_name', 'like', "%{$value}%")
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

    public function history()
    {
        return $this->morphMany(History::class, 'model');
    }
}
