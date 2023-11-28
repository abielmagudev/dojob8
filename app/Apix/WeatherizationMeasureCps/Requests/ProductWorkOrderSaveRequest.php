<?php

namespace App\Apix\WeatherizationMeasureCps\Requests;

use App\Apix\WeatherizationMeasureCps\Models\WeatherizationMeasureCps;
use Illuminate\Foundation\Http\FormRequest;

class ProductWorkOrderSaveRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'products' => [
                'array',
            ],
            'products.*' => [
                sprintf('exists:%s,id,is_available,1', WeatherizationMeasureCps::class)
            ],
            'quantities' => [
                'array',
            ],
            'quantities.*' => [
                'integer',
            ],
        ];
    }

    public function messages()
    {
        return [
            'products.*.exists' => __('One of the products is not available'),
        ];
    }
}
