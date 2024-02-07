<?php 

namespace App\Models\Kernel\Interfaces;

interface Authenticable
{
    public function getAuthenticatedNameAttribute(): string;
}
