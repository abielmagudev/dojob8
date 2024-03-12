<?php

namespace App\Xapis\Stock\BlownInsulation\Requests;

use App\Xapis\Stock\BlownInsulation\Kernel\AreaRvalueCatalog;
use App\Xapis\Stock\BlownInsulation\Kernel\BagCalculator;
use Illuminate\Foundation\Http\FormRequest;

class BlownInsulationSaveRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function prepareForValidation()
    {
        //
    }

    public function rules()
    {
        return [
            'blownins_area' => [
                'required',
                sprintf('in:%s', AreaRvalueCatalog::areas()->implode(',')),
            ],
            'blownins_rvalue_name' => [
                'required',
                sprintf('in:%s', AreaRvalueCatalog::rvalueNamesByArea($this->blownins_area)->implode(',')),
            ],
            'blownins_square_footage' => [
                'required',
                'numeric',
                'min:0.01',
            ],
            'blownins_bags' => [
                'nullable',
                'integer',
            ],
        ];
    }

    public function messages()
    {
        return [
            'blownins_area.required' => __('Area is required'),
            'blownins_area.in' => __('Area is invalid'),
            'blownins_rvalue_name.required' => __('R-Value is required'),
            'blownins_rvalue_name.in' => __('R-Value is invalid or doesn\'t belong in space'),
            'blownins_square_footage.required' => __('Square footage is required'),
            'blownins_square_footage.numeric' => __('Square footage is invalid'),
            'blownins_square_footage.min' => __('Square footage must be a minimum of 0.01'),
        ];
    }

    public function validated()
    {
        $rvalue_score = AreaRvalueCatalog::rvalueScoreByArea($this->blownins_area, $this->blownins_rvalue_name);

        return [
            'area' => $this->blownins_area,
            'rvalue_name' => $this->blownins_rvalue_name,
            'rvalue_score' => $rvalue_score,
            'square_footage' => $this->blownins_square_footage,
            'bags' => BagCalculator::calculate($this->blownins_square_footage, $rvalue_score),
        ];
    }
}
