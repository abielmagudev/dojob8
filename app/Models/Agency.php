<?php

namespace App\Models;

use App\Models\Inspection\Associated\HasInspectionsTrait;
use App\Models\Kernel\Traits\HasActiveStatus;
use App\Models\Kernel\Traits\HasHookUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agency extends Model
{
    use HasActiveStatus;
    use HasFactory;
    use HasHookUsers;
    use HasInspectionsTrait;
    use SoftDeletes;

    protected $fillable = [
        'is_active',
        'name',
        'notes',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
