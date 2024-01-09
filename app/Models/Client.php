<?php

namespace App\Models;

use App\Models\Kernel\HasAddressTrait;
use App\Models\Kernel\HasHookUsersTrait;
use App\Models\WorkOrder\HasWorkOrdersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasAddressTrait;
    use HasFactory;
    use HasHookUsersTrait;
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
        'city_name',
        'state_code',
        'country_code',
        'zip_code',
        'district_code',
        'notes',
    ];


    // Attributes 

    public function getContactDataCollectionAttribute()
    {
        return collect([
            'email'  => $this->email,
            'mobile_number' => $this->mobile_number,
            'phone_number' => $this->phone_number,
        ]);
    }

    public function getUrlSearchAddressGoogleMapsAttribute()
    {
        $query_string = $this->address_data->only([
            'street',
            'city_name',
            'state_name',
            'country_name',
            'zip_code',
        ])->implode('+');

        return sprintf("https://www.google.com.mx/maps/search/%s", $query_string);
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
