<?php

namespace App\Models\Kernel\Interfaces;

interface FilterableQueryStringContract
{
    public function getMappingFilterableQueryString(): array;
}
