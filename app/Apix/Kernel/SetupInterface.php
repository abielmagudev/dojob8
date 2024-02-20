<?php 

namespace App\Apix\Kernel;

interface SetupInterface
{
    public function name(): string;

    public function description(): string;

    public function spacename(): string;

    public function migrations(): array;
}
