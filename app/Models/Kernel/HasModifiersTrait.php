<?php

namespace App\Models\Kernel;

use App\Models\User;

trait HasModifiersTrait
{
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function eliminator()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
