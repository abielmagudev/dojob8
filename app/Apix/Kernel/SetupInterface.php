<?php 

namespace App\Apix\Kernel;

interface SetupInterface
{
    public function name(): string;

    public function description(): string;

    public function classname(): string;

    public function migrations(): array;
}
