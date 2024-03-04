<?php

namespace App\Http\Requests;

use App\Models\Crew;
use Illuminate\Foundation\Http\FormRequest;

class CrewSaveRequest extends FormRequest
{
    public $crew_id;

    public function authorize()
    {
        return auth()->user()->canAny(['create-crews', 'edit-crews']);
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
            'purposes' => [
                'nullable',
                'array',
            ],
            'purposes.*' => [
                'required_with:purposes',
                sprintf('in:%s', Crew::collectionAllPurposes()->implode(',')),
            ],
            'background_color' => [
                'required',
                'string',
                sprintf('regex:%s', Crew::COLOR_HEX_PATTERN),
            ],
            'text_color' => [
                'required',
                'string',
                sprintf('regex:%s', Crew::COLOR_HEX_PATTERN),
            ],
            'active' => [
                'nullable',
                'boolean',
            ],
        ];
    }

    public function messages()
    {
        return [
            'purposes.array' => __('Choose one or more purposes'),
            'purposes.*.in' => __('Choose one or more valid purposes'),
            'purposes.*.required_with' => __('Choose at least one purpose from the list'),
        ];
    }

    public function prepareForValidation()
    {
        $this->crew_id = $this->route('crew')->id ?? 0;
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'colors_json' => [$this->get('background_color'), $this->get('text_color')],
            'purposes_stringify' => $this->get('purposes'),
            'is_active' => (int) $this->filled('active'),
        ]);
    }
}
