<?php

namespace App\Models\Kernel;

trait HasModelHelpers
{
    // Validators

    public function hasNotes()
    {
        return ! empty($this->notes);
    }
}
