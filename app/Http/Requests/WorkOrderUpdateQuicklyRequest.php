<?php

namespace App\Http\Requests;

use App\Models\WorkOrder\Kernel\WorkOrderStatusCatalog;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class WorkOrderUpdateQuicklyRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('edit-work-orders');
    }

    public function prepareForValidation()
    {
        $this->merge([
            'attribute' => $this->route('attribute'),
        ]);
    }

    public function rules()
    {
        return [
            'attribute' => [
                'required',
                'in:ordering,schedule,status',
            ],
            'work_orders' => [
                'required',
                'array',
            ],
            'scheduled_date' => [
                'required_if:attribute,schedule',
                'date',
            ],
            'status' => [
                'required_if:attribute,status',
                sprintf('in:%s', WorkOrderStatusCatalog::all()->implode(','))
            ],
            'url_back' => [
                'required',
                'string',
            ],
        ];
    }

    public function messages()
    {
        return [
            'work_orders.required' => __('Select one or more work orders to update the status'),
            'work_orders.array' => __('Select one or more from the list of work orders to update the status'),
            'url_back.required' => __('Parameters are missing to update the status of work orders'),
            'url_back.string' => __('Valid parameters are missing to update the status of work orders'),
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator)
        {
            if( $validator->errors()->has('attribute') ) {
                abort(404);
            }

            $this->session()->flash('warning', $validator->errors()->first());
        });
    }


    /**
     * Cuando utilizas el método failedValidation() en un Form Request para personalizar la 
     * respuesta de validación, es posible que experimentes este comportamiento porque Laravel
     *  aún está procesando la solicitud como si hubiera pasado la validación. La ejecución 
     * del método del controlador y la generación de mensajes de sesión ocurren antes de que se 
     * invoque failedValidation(), por lo que es posible que ya se hayan establecido los mensajes 
     * de sesión antes de que personalices la respuesta de validación.
     * 
     * Para evitar que se ejecute el método del controlador cuando la validación falla, 
     * puedes lanzar una excepción de ValidationException dentro del método failedValidation()
     * 
     * use Illuminate\Validation\ValidationException;
     * 
     * protected function failedValidation(Validator $validator)
     * {
     *      throw new ValidationException($validator);
     * }
     * 
     * Esto detendrá el flujo de ejecución y evitará que se ejecute el método del controlador 
     * cuando la validación falla. Además, los mensajes de sesión se establecerán según la respuesta 
     * personalizada que especifiques en failedValidation().
     */

    /*
    public function failedValidation(Validator $validator)
    {
        if( $validator->errors()->has('attribute') ) {
            abort(404);
        }
    }
    */
    
}
