<?php

namespace App\Models;

use App\Models\Kernel\HasAvailabilityTrait;
use App\Models\Kernel\HasBeforeAfterTrait;
use App\Models\Kernel\HasHookUsersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Crew extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasAvailabilityTrait;
    use HasBeforeAfterTrait;
    use HasHookUsersTrait;

    protected $fillable = [
        'name',
        'description',
        'color',
        'is_active',
    ];

    public function hasColor()
    {
        return $this->color <> null;
    }
}
