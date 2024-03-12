<?php

namespace App\Models\History\Traits;

use App\Models\History;

trait HasHistory
{
    public function history()
    {
        return $this->morphMany(History::class, 'model');
    }
}
