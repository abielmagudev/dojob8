<?php

namespace App\Http\Requests;

use App\Models\Inspector;
use Illuminate\Foundation\Http\FormRequest;

class InspectorSaveRequest extends FormRequest
{
    public $inspector_id;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                sprintf('unique:%s,name,%s', Inspector::class, $this->inspector_id),
            ],
            'notes' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function prepareForValidation()
    {
        $this->inspector_id = $this->route('inspector')->id ?? 0;
    }
}
