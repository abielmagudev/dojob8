<?php

namespace App\Http\Requests;

use App\Models\Category;
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
                'required',
                sprintf('unique:%s,id,%s', Category::class, $this->route('category')->id),
            ],
            'description' => [
                'nullable',
                'string',
            ],
        ];
    }
}
