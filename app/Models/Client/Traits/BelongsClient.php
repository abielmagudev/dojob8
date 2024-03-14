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

    
    // Validators

    public function hasClient()
    {
        return ! empty( $this->client_id );
    }

    public function existsClient()
    {
        return $this->hasClient() && is_a($this->client, Client::class);
    }


    // Scopes

    public function scopeFilterByClient($query, $value)
    {
        if( is_null($value) ||! ctype_digit($value) ) {
            return $query;
        }

        if( $value == 0 ) {
            return $query->whereNull('client_id');
        }

        return $query->whereNotNull('client_id')->where('client_id', $value);
    }
}
