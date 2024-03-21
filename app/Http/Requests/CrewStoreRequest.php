<?php

namespace App\Http\Requests;

use App\Models\Crew;
use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class CrewStoreRequest extends FormRequest
{
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
                sprintf('unique:%s,name', Crew::class),
            ],
            'description' => [
                'nullable',
                'string',
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
            'tasks' => [
                'nullable',
                'array',
            ],
            'tasks.*' => [
                'required_with:tasks',
                sprintf('in:%s', Task::all()->pluck('id')->implode(',')),
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

    public function validated()
    {
        return array_merge(parent::validated(), [
            'colors_json' => [$this->get('background_color'), $this->get('text_color')],
        ]);
    }
}
