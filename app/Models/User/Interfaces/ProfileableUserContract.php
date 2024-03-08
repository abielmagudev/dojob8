<?php

namespace App\Models\User\Interfaces;

interface ProfileableUserContract
{
    public function getProfileShortAttribute(): string;

    public function getProfileNameAttribute(): string;

    public function users();
}
