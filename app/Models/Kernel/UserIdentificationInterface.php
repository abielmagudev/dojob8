<?php 

namespace App\Models\Kernel;

interface UserIdentificationInterface
{
    public function getIdentificationNameAttribute(): string;
}
