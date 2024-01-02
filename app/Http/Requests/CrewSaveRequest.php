<?php

namespace App\Http\Requests;

use App\Models\Crew;
use App\Models\Crew\CrewPainter;
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
            'task_types' => [
                'required',
                'array',
            ],
            'task_types.*' => [
                sprintf('in:%s', Crew::getTaskTypes()->implode(',')),
            ],
            'background_color' => [
                'required',
                'string',
                sprintf('regex:%s', CrewPainter::COLOR_HEX_PATTERN),
            ],
            'text_color_mode' => [
                'required',
                'string',
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

        $this->merge([
            'text_color_mode' => $this->has('text_color_mode') ? 'light' : CrewPainter::TEXT_COLOR_MODE_DEFAULT,
        ]);
    }

    public function validated()
    {
        $validated = parent::validated();

        $validated['task_types'] = json_encode($this->get('task_types', []));
        
        if(! $this->isMethod('POST') ) {
            $validated['is_active'] = (int) $this->has('is_active');
        }

        return $validated;
    }
}
