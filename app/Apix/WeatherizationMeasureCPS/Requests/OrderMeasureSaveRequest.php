<?php

namespace App\Apix\WeatherizationMeasureCps\Requests;

use App\Apix\WeatherizationMeasureCps\Models\WeatherizationMeasureCps;
use Illuminate\Foundation\Http\FormRequest;

class OrderMeasureSaveRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'measures' => [
                'array',
            ],
            'measures.*' => [
                sprintf('exists:%s,id', WeatherizationMeasureCps::class)
            ],
        ];
    }
}
