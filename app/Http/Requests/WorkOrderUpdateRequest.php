<?php

namespace App\Http\Requests;

use App\Http\Requests\WorkOrderUpdateRequest\WorkOrderUpdaterLoader;
use Illuminate\Foundation\Http\FormRequest;

class WorkOrderUpdateRequest extends FormRequest
{    
    public $loader;

    public function authorize()
    {
        return auth()->user()->can('edit-work-orders');
    }

    public function prepareForValidation()
    {
        $this->loader = new WorkOrderUpdaterLoader($this);
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

    public function validated()
    {
        return array_merge(parent::validated(), $this->loader->validated());
    }
}
