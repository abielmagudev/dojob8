<?php

namespace App\Models;

use App\Models\Inspection\Associated\HasInspectionsTrait;
use App\Models\Kernel\Interfaces\Profilable;
use App\Models\Kernel\Traits\HasActiveStatus;
use App\Models\Kernel\Traits\HasHookUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agency extends Model implements Profilable
{
    use HasActiveStatus;
    use HasFactory;
    use HasHookUsers;
    use HasInspectionsTrait;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'notes',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];


    // Interface

    public function getProfiledNameAttribute(): string
    {
        return $this->name;
    }

    // Actions

    public function down()
    {
        Job::removeFromInspectionsSetup('agency', $this->id);
    }
}
