<?php

namespace App\Http\Requests;

use App\Models\Crew;
use Illuminate\Foundation\Http\FormRequest;

class CrewSaveRequest extends FormRequest
{
    public $crew_id;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'bail',
                'required',
                'string',
                sprintf('unique:%s,name,%s', Crew::class, $this->crew_id),
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'color' => [
                'nullable',
                'string',
                'regex:/^#[0-9A-Fa-f]{6}$/',
            ],
            'is_active' => [
                'nullable',
                'boolean',
            ],
        ];
    }

    public function prepareForValidation()
    {
        $this->crew_id = $this->route('crew')->id ?? 0;
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'is_active' => $this->isMethod('POST') || $this->has('is_active') ? 1 : 0,
        ]);
    }
}
