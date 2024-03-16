<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('create-product');
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                sprintf('unique:%s,name', Product::class),
            ],
            'item_price_id' => [
                'nullable',
                'string',
            ],
            'material_price' => [
                'required',
                'numeric',
                // 'regex:/^\d+(\.\d{2})?$/', // 2 Decimales
            ],
            'labor_price' => [
                'required',
                'numeric',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'category' => [
                'bail',
                'nullable',
                'integer',
                sprintf('exists:%s,id', Category::class),
            ],
        ];
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            // 'unit_price' => ($this->material_price + $this->labor_price),
            'category_id' => $this->get('category'),
        ]);
    }
}
