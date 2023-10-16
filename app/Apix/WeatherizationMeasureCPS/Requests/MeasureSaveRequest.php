<?php

namespace App\Apix\WeatherizationMeasureCps\Requests;

use App\Apix\WeatherizationMeasureCps\Models\WeatherizationMeasureCps;
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
            ],
            'name' => [
                'required',
                sprintf('unique:%s,name,%s', WeatherizationMeasureCps::class, $this->measure_id),
            ],
            'material_price' => [
                'required',
            ],
            'labor_price' => [
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'item_price_id.required' => __('The item field is required.'),
        ];
    }

    public function prepareForValidation()
    {
        $this->measure_id = $this->get('measure', 0);
    }
}
