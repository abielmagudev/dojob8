<?php

namespace App\Apix;

abstract class Installer
{
    public function __call($name, $arguments)
    {
        return property_exists($this, $name) ? $this->$name : null;
    }

    public function data(): array
    {
        return [
            'name' => $this->name(),
            'description' => $this->description(),
            'classname' => $this->classname(),
        ];
    }

    /**
     * Retorna un array con los nombres y paths con extensions de las migraciones.
     * 
     * $table_name(key) => $migration_path.php(value)
     * 
     * @return array
     */
    abstract public function migrations(): array;
}
