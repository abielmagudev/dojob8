<?php

namespace App\Http\Requests;

use App\Http\Requests\WorkOrderRequest\ResolveExtensionRequestsTrait;
use App\Http\Requests\WorkOrderRequest\Update\Loader;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class WorkOrderUpdateRequest extends FormRequest
{    
    use ResolveExtensionRequestsTrait;

    public $loader;

    public function authorize()
    {
        return auth()->user()->can('edit-work-orders');
    }

    public function prepareForValidation()
    {
        $this->loader = new Loader($this);
        $this->loader->prepareForValidation();
    }

    public function rules()
    {
        return $this->loader->rules();
    }

    public function messages()
    {
        return $this->loader->messages();
    }

    public function withValidator(Validator $validator)
    {
        // dd( $validator->errors() );
    }

    public function passedValidation()
    {
        $this->merge([
            'cache' => [
                'extensions' => $this->route('work_order')->job->extensions,
                'resolved_requests' => $this->resolveExtensionRequests(
                    $this->route('work_order')->job->extensions,
                    'update'
                ),
            ],
        ]);
    }

    public function validated()
    {
        return array_merge(parent::validated(), $this->loader->validated());
    }
}
