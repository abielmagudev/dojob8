<?php 

namespace App\Models\Kernel;

interface AuthenticatedUserMetadataInterface
{
    public function getMetaNameAttribute(): string;
}
