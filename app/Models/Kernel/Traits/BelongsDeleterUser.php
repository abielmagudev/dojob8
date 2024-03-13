<?php

namespace App\Models\Kernel\Traits;

use App\Models\User;

trait BelongsDeleterUser
{
    // Relationship

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_id');
    }


    // Validators

    public function hasDeleter()
    {
        return ! empty($this->deleted_id);
    }

    public function deleterExists()
    {
        return $this->hasDeleter() && is_a($this->deleter, User::class);
    }
}
