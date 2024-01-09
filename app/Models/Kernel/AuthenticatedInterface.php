<?php 

namespace App\Models\Kernel;

interface AuthenticatedInterface
{
    public function getAuthenticatedNameAttribute(): string;
}
