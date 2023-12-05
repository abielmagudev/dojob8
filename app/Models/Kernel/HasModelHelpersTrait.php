<?php

namespace App\Models\Kernel;

trait HasModelHelpersTrait
{
    // Validators

    public function hasNotes()
    {
        return ! empty($this->notes);
    }

    public function hasDescription()
    {
        return ! empty($this->description);
    }
}
