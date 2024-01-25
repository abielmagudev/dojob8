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
                'required',
                'array',
            ],
            'tasks.*' => [
                sprintf('in:%s', Crew::getAllTasks()->implode(',')),
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
            'is_active' => [
                'nullable',
                'boolean',
            ],
        ];
    }

    public function messages()
    {
        return [
            'task_types.required' => __('Choose at least one type of task from the list'),
            'task_types.array' => __('Choose some type of task from the list'),
            'task_types.*.in' => __('Choose some valid type of task'),
        ];
    }

    public function prepareForValidation()
    {
        $this->crew_id = $this->route('crew')->id ?? 0;
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'is_active' => $this->isMethod('PATCH') || $this->isMethod('PUT') ? (int) $this->has('is_active') : 1,
            'task_types' => json_encode($this->get('task_types', [])),
            'background_color_hex' => $this->get('background_color'),
            'text_color_hex' => $this->get('text_color'),
        ]);
    }
}
