<?php

namespace App\Models\Kernel;

use Illuminate\Support\Collection;

trait HasHistoryChangesTrait
{
    /**
     * Nombres de propiedades escondidas o ignoradas por default.
     */
    protected $hidden_changes = [
        'id',
        'created_by', 
        'updated_by', 
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * IMPORTANTE:
     * 
     * Declarar "protected $ignore_changes" con un valor array con los nombres de
     * las propiedades a ignorar o excluir de la muestra de las propiedades modificadas.
     * 
     * En caso de NO estar declarada, por default se fusiona con array vacio.
     */
    public function getExceptChanges()
    {
        return array_merge($this->hidden_changes, ($this->ignore_changes ?? []));
    }

    public function getOriginalWasChanged(): Collection
    {
        $changes = collect( $this->getChanges() )->except( 
            $this->getExceptChanges() 
        );

        $original = collect( $this->getOriginal() )->except(
            $this->getExceptChanges()
        );

        return $original->intersectByKeys($changes);
    }
}
