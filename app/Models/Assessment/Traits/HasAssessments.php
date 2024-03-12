<?php

namespace App\Models\Assessment\Traits;

use App\Models\Assessment;

trait HasAssessments
{
    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }
}
