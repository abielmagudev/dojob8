<?php

namespace App\Xapis\Stock\BattInsulation\Requests;

use App\Xapis\Stock\BattInsulation\Kernel\AreaRvalueCatalog;
use App\Xapis\Stock\BattInsulation\Kernel\SizeCatalog;
use App\Xapis\Stock\BattInsulation\Kernel\TypeCatalog;
use Illuminate\Foundation\Http\FormRequest;

class BattInsulationSaveRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'battins_area' => [
                'required',
                sprintf('in:%s', AreaRvalueCatalog::areas()->implode(',')),
            ],
            'battins_rvalue_name' => [
                'required',
                sprintf('in:%s', AreaRvalueCatalog::rvalueNamesByArea($this->battins_area)->implode(',')),
            ],
            'battins_size' => [
                'required',
                sprintf('in:%s', SizeCatalog::all()->implode(',')),
            ],
            'battins_type' => [
                'required',
                sprintf('in:%s', TypeCatalog::all()->implode(',')),
            ],
            'battins_square_footage' => [
                'required',
                'numeric',
                'min:0.01',
            ],
            'battins_square_footage_netting' => [
                'nullable',
                'numeric',
                'min:0.01',
            ],
        ];
    }

    public function messages()
    {
        return [
            'battins_area.required' => __('Area is required'),
            'battins_area.in' => __('Area is invalid'),
            'battins_rvalue_name.required' => __('R-Value is required'),
            'battins_rvalue_name.in' => __('R-Value is invalid or doesn\'t belong in area'),
            'battins_size.required' => __('Size is required'),
            'battins_size.in' => __('Size is invalid'),
            'battins_type.required' => __('Type is required'),
            'battins_type.in' => __('Type is invalid'),
            'battins_square_footage.required' => __('Square footage is required'),
            'battins_square_footage.numeric' => __('Square footage is invalid'),
            'battins_square_footage.min' => __('Square footage must be a minimum of 0.01'),
            'battins_square_footage_netting.numeric' => __('Square footage of Netting is invalid'),
            'battins_square_footage_netting.min' => __('Square footage of Netting must be a minimum of 0.01'),
        ];
    }

    public function validated()
    {
        return [
            'area' => $this->battins_area,
            'rvalue_name' => $this->battins_rvalue_name,
            'size' => $this->battins_size,
            'type' => $this->battins_type,
            'square_footage' => $this->battins_square_footage,
            'square_footage_netting' => $this->battins_square_footage_netting,
        ];
    }
}
