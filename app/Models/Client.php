<?php

namespace App\Models;

use App\Models\Kernel\HasCountryStateCodesTrait;
use App\Models\Kernel\HasHistoryChangesTrait;
use App\Models\Kernel\HasHookUsersTrait;
use App\Models\Kernel\HasModelHelpersTrait;
use App\Models\WorkOrder\HasWorkOrdersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasCountryStateCodesTrait;
    use HasFactory;
    use HasHistoryChangesTrait;
    use HasHookUsersTrait;
    use HasModelHelpersTrait;
    use HasWorkOrdersTrait;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'last_name',
        'full_name',
        'phone_number',
        'mobile_number',
        'email',
        'street',
        'city',
        'state_code',
        'country_code',
        'zip_code',
        'district_code',
        'notes',
    ];

    protected $ignore_changes = [
        'full_name',
    ];



    // Attributes 

    public function getAddressDataCollectionAttribute()
    {
        return collect([
            'street' => $this->street,
            'city_name' => $this->city,
            'state_code' => $this->state_code,
            'state_name' => $this->state_name,
            'country_code' => $this->country_code,
            'country_name' => $this->country_name,
            'zip_code' => $this->zip_code,
            'district_code' => $this->district_code,
        ]);
    }

    public function getContactDataCollectionAttribute()
    {
        return collect([
            'phone'  => $this->phone_number,
            'mobile' => $this->mobile_number,
            'email'  => $this->email,
        ]);
    }

    public function getUrlSearchAddressGoogleMapsAttribute()
    {
        $query_string = $this->address_data_collection->only([
            'street',
            'city_name',
            'state_name',
            'country_name',
            'zip_code',
        ])->implode('+');

        return sprintf("https://www.google.com.mx/maps/search/%s", $query_string);
    }

    public function getAddressAttribute()
    {
        return $this->address_data_collection->only(['street', 'state_code', 'country_code', 'zip_code'])->implode(', ');
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

    public function history()
    {
        return $this->morphMany(History::class, 'model');
    }
}
