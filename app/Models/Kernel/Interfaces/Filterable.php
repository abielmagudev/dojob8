<?php

namespace App\Models\Kernel\Interfaces;

interface Filterable
{
    public function getParameterFilterSettings(): array;
}
