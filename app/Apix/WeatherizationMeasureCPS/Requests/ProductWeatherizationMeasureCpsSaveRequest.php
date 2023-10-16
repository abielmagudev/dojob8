<?php

namespace App\Apix\WeatherizationMeasureCPS\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductWeatherizationMeasureCpsSaveRequest extends FormRequest
{
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
}
