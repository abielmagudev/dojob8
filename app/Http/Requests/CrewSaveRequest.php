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
            'tasks' => [
                'nullable',
                'array',
            ],
            'tasks.*' => [
                'required_with:tasks',
                sprintf('in:%s', Crew::allTasks()->implode(',')),
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
            'tasks.array' => __('Choose one or more tasks'),
            'tasks.*.in' => __('Choose one or more valid tasks'),
            'tasks.*.required_with' => __('Choose at least one task from the list'),
        ];
    }

    public function prepareForValidation()
    {
        $this->crew_id = $this->route('crew')->id ?? 0;
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'background_color_hex' => $this->get('background_color'),
            'tasks_json' => json_encode( $this->get('tasks', []) ),
            'text_color_hex' => $this->get('text_color'),
            'is_active' => $this->filled('active'),
        ]);
    }
}
