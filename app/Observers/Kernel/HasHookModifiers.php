<?php

namespace App\Observers\Kernel;

use Illuminate\Database\Eloquent\Model;

trait HasHookModifiers
{
    public function storingBy(Model $model)
    {
        if( $model->exists('created_by') ) {
            $model->created_by = mt_rand(1, 10);
        }

        $this->updatingBy($model);
    }

    public function updatingBy(Model $model)
    {
        if(! $this->request->isMethod('delete') )
        {
            if( $model->exists('updated_by') ) {
                $model->updated_by = mt_rand(1, 10);
            }
        }
    }

    public function deletingBy(Model $model)
    {
        if( $model->exists('deleted_by') ) {
            $model->timestamps = false;
            $model->deleted_by = mt_rand(1, 10);
            $model->save();
        }
    }
}
