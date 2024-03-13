<?php

namespace App\Models;

use App\Models\History\Traits\HasHistory;
use App\Models\Kernel\Interfaces\FilterableQueryStringContract;
use App\Models\Kernel\Traits\BelongsCreatorUser;
use App\Models\Kernel\Traits\BelongsDeleterUser;
use App\Models\Kernel\Traits\BelongsUpdaterUser;
use App\Models\Kernel\Traits\HasAddress;
use App\Models\Kernel\Traits\HasContactChannels;
use App\Models\Kernel\Traits\HasFilterableQueryStringContract;
use App\Models\WorkOrder\Traits\HasWorkOrders;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Client extends Model implements FilterableQueryStringContract
{
    use BelongsCreatorUser;
    use BelongsDeleterUser;
    use BelongsUpdaterUser;
    use HasAddress;
    use HasContactChannels;
    use HasFactory;
    use HasFilterableQueryStringContract;
    use HasHistory;
    use HasWorkOrders;
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

    protected $appends = [
        'address_simple',
        'contact_channels',
    ];


    // Interface

    public function getMappingFilterableQueryString(): array
    {
        return [
            'search' => 'filterBySearch',
        ];
    }


    // Mutators

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::title($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = Str::title($value);
    }

    public function setFullNameAttribute($value)
    {
        $this->attributes['full_name'] = Str::title($value);
    }


    // Accessors

    public function getAddressSimpleAttribute()
    {
        $address_simple = $this->address_data->only([
            'street',
            'city_name',
            'state_code',
            'country_code',
            'zip_code',
        ]);

        return $address_simple->implode(', ');
    }

    public function getContactChannelsAttribute()
    {  
        return $this->contact_data->filter()->implode(', ');
    }


    // Validators

    public function hasDistrictCode()
    {
        return ! is_null($this->district_code);
    }


    // Actions

    public function generateUrlGoogleMaps()
    {
        $query = $this->address_data->only([
            'street',
            'city_name',
            'state_name',
            'country_name',
            'zip_code',
        ])->implode('+');

        return sprintf("https://www.google.com.mx/maps/search/%s", $query);
    }

    
    // Scopes

    public function scopeSearch($query, $value)
    {
        return $query->where('full_name', 'like', "%{$value}%")
                     ->orWhere('phone_number', 'like', "%{$value}%")
                     ->orWhere('mobile_number', 'like', "%{$value}%")
                     ->orWhere('email', 'like', "%{$value}%")
                     ->orWhere('street', 'like', "%{$value}%")
                     ->orWhere('city_name', 'like', "%{$value}%")
                     ->orWhere('zip_code', 'like', "%{$value}%");
    }


    // Filters

    public function scopeFilterBySearch($query, $value)
    {
        return ! empty($value) ? $query->search($value) : $query;
    }
}
