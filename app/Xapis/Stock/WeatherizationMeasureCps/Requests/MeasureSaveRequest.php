<?php

namespace App\Xapis\Stock\WeatherizationMeasureCps\Requests;

use App\Xapis\Stock\WeatherizationMeasureCps\Models\WeatherizationMeasureCps;
use Illuminate\Foundation\Http\FormRequest;

class MeasureSaveRequest extends FormRequest
{
    public $measure_id;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'item_price_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'required',
                sprintf('unique:%s,name,%s', WeatherizationMeasureCps::class, $this->measure_id),
            ],
            'material_price' => [
                'required',
                'numeric',
            ],
            'labor_price' => [
                'required',
                'numeric'
            ],
            'notes' => [
                'nullable',
                'string',
            ],
            'is_available' => [
                'nullable',
            ]
        ];
    }

    public function messages()
    {
        return [
            'item_price_id.required' => __('The item price ID field is required.'),
        ];
    }

    public function prepareForValidation()
    {
        $this->measure_id = $this->get('measure', 0);
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'is_available' => (int) ($this->isMethod('post') || $this->is_available == 1),
        ]);
    }
}
