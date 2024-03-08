<?php

namespace App\Models;

use App\Models\Inspection\Traits\HasInspections;
use App\Models\Kernel\Traits\HasActiveStatus;
use App\Models\Kernel\Traits\HasHookUsers;
use App\Models\User\Interfaces\ProfileableUserContract;
use App\Models\User\Traits\HasUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agency extends Model implements ProfileableUserContract
{
    use HasFactory;
    use HasActiveStatus;
    use HasHookUsers;
    use HasInspections;
    use HasUsers;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'mobile_number',
        'phone_number',
        'notes',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];


    // Interface

    public function getProfileNameAttribute(): string
    {
        return $this->name;
    }

    // Actions

    public function down()
    {
        Job::removeFromInspectionsSetup('agency', $this->id);
    }
}
