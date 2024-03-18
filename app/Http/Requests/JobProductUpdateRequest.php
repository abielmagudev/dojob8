<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class JobProductUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('edit-jobs');
    }

    public function rules()
    {
        return [
            'products' => [
                'sometimes',
                'array',
            ],
            'products.*' => [
                'bail',
                'integer',
                sprintf('exists:%s,id', Product::class)
            ],
        ];
    }

    public function messages()
    {
        return [
            'products' => __('Choose from the list of products shown'),
            'products.*' => __('Only products from the list shown'),
        ];
    }
}
