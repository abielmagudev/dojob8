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
