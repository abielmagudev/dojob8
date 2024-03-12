<?php

namespace App\Models\Client\Traits;

use App\Models\Client;

trait BelongsClient
{
    // Relationship

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
