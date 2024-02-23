<?php

namespace App\Xapis\Stock\WeatherizationProductCps\Requests;

use App\Xapis\Stock\WeatherizationProductCps\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategorySaveRequest extends FormRequest
{
    public $category_id;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                sprintf('unique:%s,name,%s', Category::class, $this->cache['category']->id),
            ],
        ];
    }

    public function prepareForValidation()
    {
        $category = !$this->isMethod('POST') 
                  ? Category::findOrFail( $this->category ) 
                  : new class { public $id = 0; };

        $this->merge([
            'cache' => [
                'category' => $category,
            ]
        ]);
    }
}