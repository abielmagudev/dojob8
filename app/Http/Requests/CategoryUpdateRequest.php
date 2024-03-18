<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Rules\CategoryRestrictedName;
use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('edit-categories');
    }

    public function rules()
    {
        return [
            'name' => [
                'bail',
                'required',
                new CategoryRestrictedName,
                sprintf('unique:%s,id,%s', Category::class, $this->route('category')->id),
            ],
            'description' => [
                'nullable',
                'string',
            ],
        ];
    }
}
