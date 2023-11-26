<?php

namespace App\Models\Kernel;

use Illuminate\Support\Collection;

trait HasHistoryChangesTrait
{
    /**
     * IMPORTANTE:
     * 
     * Declarar "protected $ignore_changes" con un valor array.
     * 
     * Esta propiedad es para ignorar aquellas propiedades que no son de interés
     * en el cambio de su estado o son confidenciales.
     * 
     */
    public function getOriginalWasChanged(): Collection
    {
        $changes = collect( $this->getChanges() )->except( 
            $this->ignore_changes 
        );

        $original = collect( $this->getOriginal() )->except(
            $this->ignore_changes
        );

        return $original->intersectByKeys($changes);
    }
}
