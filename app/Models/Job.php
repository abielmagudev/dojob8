<?php

namespace App\Models;

use App\Models\Kernel\HasAvailableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    use HasAvailableTrait;

    protected $fillable = [
        'name',
        'description',
        'approved_inspections_required',
        'is_available',
    ];


    // Validators

    public function hasExtensions(): bool
    {
        return (bool) ($this->extensions_count ?? $this->extensions->count());
    }

    
    // Relationships

    public function extensions()
    {
        return $this->belongsToMany(Extension::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
