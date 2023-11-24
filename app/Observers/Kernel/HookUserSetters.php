<?php

namespace App\Observers\Kernel;

use Illuminate\Database\Eloquent\Model;

trait HookUserSetters
{
    /**
     * Establece el valor de "created_by" con el id del usuario autenticado
     * en el hook "creating" de Eloquent.
     */
    public function storingBy(Model $model, int $auth_id)
    {
        $model->created_by = $auth_id;
    }

    /**
     * Establece el valor de "updated_by" con el id del usuario autenticado
     * en el hook "updating" de Eloquent.
     * 
     * Verifíca que la petición no sea "delete" y así mantener el id del último usuario 
     * autenticado que actualizo el modelo en un caso de recuperación de este.
     */
    public function updatingBy(Model $model, int $auth_id)
    {
        if(! $this->request->isMethod('delete') ) {
            $model->updated_by = $auth_id;
        }
    }

    /**
     * Establece el valor de "deleted_by" con el id del usuario autenticado
     * en el hook "deleting" de Eloquent.
     * 
     * IMPORTANTE: Este método solamente funciona si el modelo es SoftDelete.
     * 
     * En el ciclo de vida para el SoftDelete, se asigna valor a "deleted_at" en 
     * el hook 'deleting', despúes se ejecuta el hook "updating" para asignar el valor
     * a "updated_at", de manera que ambos campos "deleted_at" y "updated_at"
     * tienen el mismo valor de tiempo.
     * 
     * Para evitar que el campo "updated_at" se alteré, se desactiva la propiedad
     * "timestamps" para afectar solamente los campos "deleted_at". 
     * 
     * Una vez desactivada la propiedad "timestamps", se asigna el id del usuario 
     * autenticado a "deleted_by" y se guarda manualmente, ya que por default en el 
     * hook "deleting" afecta solamente al campo "deleted_at".
     */
    public function deletingBy(Model $model, int $auth_id)
    {
        if( $model->timestamps ) {
            $model->timestamps = false;
        }

        $model->deleted_by = $auth_id;
        $model->save();
    }
}
