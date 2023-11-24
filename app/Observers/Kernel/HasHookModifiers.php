<?php

namespace App\Observers\Kernel;

use Closure;
use Illuminate\Database\Eloquent\Model;

trait HasHookModifiers
{
    public function withoutTimestamps(Model $model, Closure $closure)
    {
        $model->timestamps = false;

        $closure($model);
    }

    public function storingBy(Model $model)
    {
        $model->created_by = mt_rand(1, 10);

        $this->updatingBy($model);
    }

    public function updatingBy(Model $model)
    {
        if(! $this->request->isMethod('delete') ) {
            $model->updated_by = mt_rand(1, 10);
        }
    }

    public function deletingBy(Model $model)
    {
        if( $model->exists('deleted_by') ) {
            $this->withoutTimestamps($model, function ($model) {
                $model->deleted_by = mt_rand(1, 10);
                $model->save();
            });
        }
    }
}
