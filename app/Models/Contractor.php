<?php

namespace App\Models;

use App\Models\History\Traits\HasHistory;
use App\Models\Kernel\Traits\BelongsCreatorUser;
use App\Models\Kernel\Traits\BelongsDeleterUser;
use App\Models\Kernel\Traits\BelongsUpdaterUser;
use App\Models\Kernel\Traits\HasActiveStatus;
use App\Models\Kernel\Traits\HasAddress;
use App\Models\Kernel\Traits\HasContactChannels;
use App\Models\User\Interfaces\ProfileableUserContract;
use App\Models\User\Traits\HasUsers;
use App\Models\WorkOrder\Traits\HasWorkOrders;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Contractor extends Model implements ProfileableUserContract
{
    use BelongsCreatorUser;
    use BelongsDeleterUser;
    use BelongsUpdaterUser;
    use HasActiveStatus;
    use HasAddress;
    use HasContactChannels;
    use HasFactory;
    use HasHistory;
    use HasUsers;
    use HasWorkOrders;
    use SoftDeletes;
    
    protected $fillable = [
        'is_active',
        'name',
        'alias',
        'contact_name',
        'phone_number',
        'mobile_number',
        'email',
        'street',
        'city_name',
        'state_code',
        'country_code',
        'zip_code',
        'notes',
    ];


    // Interface

    public function getProfileNameAttribute(): string
    {
        return sprintf('%s (%s)', $this->name, $this->alias);
    }


    // Mutators

    public function setContactNameAttribute($value)
    {
        $this->attributes['contact_name'] = Str::title($value);
    }


    // Actions

    public function down()
    {
        $this->users->each(fn($user) => $user->saveInactive());
    }

    public function up()
    {
        $this->users->each(fn($user) => $user->saveActive());
    }
}
