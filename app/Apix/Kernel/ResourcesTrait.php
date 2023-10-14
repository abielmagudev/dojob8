<?php

namespace App\Apix\Kernel;

use Illuminate\Support\Facades\View;

trait ResourcesTrait
{
    public function dir()
    {
        return (explode('\\', self::class))[2];
    }

    public function path(string $resource, string $filename)
    {
        return app_path(
            sprintf('Apix/%s/resources/%s/%s', $this->dir(), $resource, $filename)
        );
    }

    public function view(string $template, array $data = [])
    {
        $resource = $this->path('views', "{$template}.blade.php");

        return View::file($resource, $data);
    }
}
