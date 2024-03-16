<?php

namespace App\Models\Kernel\Interfaces;

interface PendingAttributesContract
{
    // Validators 

    public function hasPending(): bool;

    public function hasNoPending(): bool;

    public function hasPendingAttribute(string $attr): bool;

    public function hasNoPendingAttribute(string $attr): bool;


    // Scopes

    public function scopePending($query);

    public function scopeNoPending($query);

    public function scopeAsPendingCount($query);

    public function scopeAsNoPendingCount($query);


    // Filters

    public function scopeFilterByPending($query, $value);
}   
