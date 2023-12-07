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

    public function prepareForValidation()
    {
        $this->crew_id = $this->route('crew')->id ?? 0;

        $this->merge([
            'text_color_mode' => $this->has('text_color_mode') ? 'light' : CrewPainter::TEXT_COLOR_MODE_DEFAULT,
        ]);
    }

    public function validated()
    {
        if( $this->isMethod('POST') ) {
            return parent::validated();
        }

        return array_merge(parent::validated(), [
            'is_active' => (int) $this->has('is_active'),
        ]);
    }
}
