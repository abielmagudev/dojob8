<?php

namespace App\Models\Media\Traits;

use App\Models\Media;

trait HasMedia
{
    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
