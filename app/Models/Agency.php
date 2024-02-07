<?php

namespace App\Models;

use App\Models\Kernel\HasHookUsersTrait;
use App\Models\Kernel\Traits\HasActiveStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agency extends Model
{
    use HasFactory;
    use HasHookUsersTrait;
    use HasActiveStatus;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'notes',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',
    ];


    // Relationships

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }
}
