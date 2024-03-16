<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('create-categories');
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                sprintf('unique:%s', Category::class),
            ],
            'description' => [
                'nullable',
                'string',
            ],
        ];
    }
}
