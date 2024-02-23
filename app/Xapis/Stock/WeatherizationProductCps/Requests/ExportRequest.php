<?php

namespace App\Xapis\Stock\WeatherizationProductCps\Requests;

use App\Xapis\Stock\WeatherizationProductCps\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ExportRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product' => [
                'bail',
                'nullable',
                'integer',
                sprintf('exists:%s,id', Product::class),
            ],
            'from' => [
                'nullable',
                'date',
            ],
            'to' => [
                'nullable',
                'date',
            ],
        ];
    }
}