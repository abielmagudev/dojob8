<?php

namespace App\Models\Kernel\Traits;

use App\Models\User;

trait BelongsUpdaterUser
{
    // Relationship

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_id');
    }


    // Validators

    public function hasUpdater()
    {
        return ! empty($this->updated_id);
    }

    public function updaterExists()
    {
        return $this->hasUpdater() && is_a($this->updater, User::class);
    }
}
