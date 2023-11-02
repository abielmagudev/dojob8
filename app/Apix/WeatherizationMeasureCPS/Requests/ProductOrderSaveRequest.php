<?php

namespace App\Apix\WeatherizationMeasureCps\Requests;

use App\Apix\WeatherizationMeasureCps\Models\WeatherizationMeasureCps;
use Illuminate\Foundation\Http\FormRequest;

class ProductOrderSaveRequest extends FormRequest
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
                sprintf('exists:%s,id', WeatherizationMeasureCps::class)
            ],
            'quantities' => [
                'array',
            ],
            'quantities.*' => [
                'integer',
            ],
        ];
    }
}
