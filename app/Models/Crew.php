<?php

namespace App\Models;

use App\Models\Kernel\HasModifiersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Crew extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasModifiersTrait;

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

    public function isActive()
    {
        return (bool) $this->is_active;
    }
}
