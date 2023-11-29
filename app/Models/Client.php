<?php

namespace App\Models;

use App\Models\Kernel\HasBeforeAfterTrait;
use App\Models\Kernel\HasCountryStateCodesTrait;
use App\Models\Kernel\HasHistoryChangesTrait;
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
    use HasHistoryChangesTrait;

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

    public function getContactDataCollectionAttribute()
    {
        return collect([
            'phone'  => $this->phone_number,
            'mobile' => $this->mobile_number,
            'email'  => $this->email,
        ]);
    }

    public function getContactDataApiHtmlAttribute()
    {
        return $this->contact_data_collection->filter()->map(function ($data, $key) {
            if( $key == 'email' ) {
                return "<a href='mailto:{$data}'>{$data}</a>";
            }

            return "<a href='tel:{$data}'>{$data}</a>";
        });
    }

    public function getAddressDataCollectionAttribute()
    {
        return collect([
            'street' => $this->street,
            'city_name' => $this->city,
            'state_code' => $this->state_code,
            'state_name' => $this->state_name,
            'country_code' => $this->country_,
            'country_name' => $this->country_name,
            'zip_code' => $this->zip_code,
            'district' => $this->district,
        ]);
    }

    public function getAddressAttribute()
    {
        $data = [
            $this->street,
            $this->location_country_code,
        ];

        return implode(', ', $data);
    }

    public function getAddressWithZipCodeAttribute()
    {
        return "{$this->address}, {$this->zip_code}";
    }

    public function getGoogleMapsUrlSearchAddressAttribute()
    {
        return sprintf("https://www.google.com.mx/maps/search/%s", 
            $this
            ->address_data_collection
            ->only([
                'street',
                'city_name',
                'state_code',
                'zip_code',
            ])
            ->implode('+')
        );
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

    public function work_orders()
    {
        return $this->hasMany(WorkOrder::class);
    }

    public function history()
    {
        return $this->morphMany(History::class, 'model');
    }
}
