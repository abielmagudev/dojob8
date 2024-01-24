<?php

namespace App\Apix\Stock\CpsProductMeasures\Requests;

use App\Apix\Stock\CpsProductMeasures\Models\Product;
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
        ];
    }

    public function messages()
    {
        return [
            'products.*.exists' => __('One of the products is not available'),
        ];
    }
}
