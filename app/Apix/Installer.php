<?php

namespace App\Apix;

abstract class Installer
{
    abstract public function migrations(): array;

    public function __call($name, $arguments)
    {
        return property_exists($this, $name) ? $this->$name : null;
    }

    public function toCreate(): array
    {
        return [
            'title' => $this->title(),
            'description' => $this->description(),
            'namespace' => $this->namespace(),
            'classname' => $this->classname(),
        ];
    }
}
