<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Rules\CategoryRestrictedName;
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
                'bail',
                'required',
                new CategoryRestrictedName,
                sprintf('unique:%s', Category::class),
            ],
            'description' => [
                'nullable',
                'string',
            ],
        ];
    }
}
