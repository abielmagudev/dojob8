<?php

namespace App\Models\Assessment\Traits;

use App\Models\Assessment;

trait BelongsAssessment
{
    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
}
