<?php

namespace App\Models\Kernel;

interface FilteringInterface
{
    public function getInputFilterSettings(): array;
}
