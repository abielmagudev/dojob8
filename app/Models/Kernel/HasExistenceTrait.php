<?php

namespace App\Models\Kernel;

trait HasExistenceTrait
{
    public function isReal(string $attribute = 'id')
    {
        return ! is_null($this->$attribute);
    }

    public function isFake(string $attribute = 'id')
    {
        return is_null($this->$attribute);
    }
}
