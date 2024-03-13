<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('edit-product');
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                sprintf('unique:%s,name,%s', Product::class, $this->route('product')->id)
            ],
            'item_price_id' => [
                'nullable',
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
            'description' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'unit_price' => ($this->material_price + $this->labor_price),
        ]);
    }
}
