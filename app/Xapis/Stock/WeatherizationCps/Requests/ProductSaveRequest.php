<?php

namespace App\Xapis\Stock\WeatherizationCps\Requests;

use App\Xapis\Stock\WeatherizationCps\Models\Category;
use App\Xapis\Stock\WeatherizationCps\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductSaveRequest extends FormRequest
{
    public $product_id;
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                sprintf('unique:%s,name,%s', Product::class, $this->cache['product']->id),
            ],
            'category' => [
                'nullable',
                sprintf('exists:%s,id', Category::class),
            ],
            'item_price_id' => [
                'required',
                'string',
            ],
            'material_price' => [
                'required',
                'numeric',
            ],
            'labor_price' => [
                'required',
                'numeric',
            ],
            'notes' => [
                'nullable',
                'string',
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
        $product = ! $this->isMethod('POST') 
                 ? Product::findOrFail( $this->product ) 
                 : new class { public $id = 0; };

        $this->merge([
            'cache' => [
                'product' => $product,
            ]
        ]);
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'category_id' => $this->get('category'),
        ]);
    }
}
