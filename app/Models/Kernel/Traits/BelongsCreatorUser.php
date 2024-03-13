<?php

namespace App\Models\Kernel\Traits;

use App\Models\User;

trait BelongsCreatorUser
{
    // Relationship

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_id')->withTrashed();
    }


    // Validators

    public function hasCreator()
    {
        return ! empty($this->created_id);
    }

    public function creatorExists()
    {
        return $this->hasCreator() && is_a($this->creator, User::class);
    }
}
