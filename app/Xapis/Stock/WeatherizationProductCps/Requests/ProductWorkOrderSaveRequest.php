<?php

namespace App\Xapis\Stock\WeatherizationProductCps\Requests;

use App\Xapis\Stock\WeatherizationProductCps\Models\Product;
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
                sprintf('exists:%s,id,is_available,1', Product::class)
            ],
            'quantities' => [
                'array',
            ],
            'quantities.*' => [
                'integer',
            ],
            'indications' => [
                'array',
            ],
            'indications.*' => [
                'nullable',
                'string',
            ]
        ];
    }

    public function messages()
    {
        return [
            'products.*.exists' => __('One of the products is not available'),
        ];
    }
}
