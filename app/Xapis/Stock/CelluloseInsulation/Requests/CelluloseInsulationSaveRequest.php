<?php

namespace App\Xapis\Stock\CelluloseInsulation\Requests;

use App\Xapis\Stock\CelluloseInsulation\Kernel\AreaRvalueCatalog;
use App\Xapis\Stock\CelluloseInsulation\Kernel\BagCalculator;
use Illuminate\Foundation\Http\FormRequest;

class CelluloseInsulationSaveRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'celluloseins_area' => [
                'required',
                sprintf('in:%s', AreaRvalueCatalog::areas()->implode(',')),
            ],
            'celluloseins_rvalue_name' => [
                'required',
                sprintf('in:%s', AreaRvalueCatalog::rvalueNamesByArea($this->celluloseins_area)->implode(',')),
            ],
            'celluloseins_square_footage' => [
                'required',
                'numeric',
                'min:0.01',
            ],
            'celluloseins_bags' => [
                'nullable',
                'integer',
            ],
        ];
    }

    public function messages()
    {
        return [
            'celluloseins_area.required' => __('Area is required'),
            'celluloseins_area.in' => __('Area is invalid'),
            'celluloseins_rvalue_name.required' => __('R-Value is required'),
            'celluloseins_rvalue_name.in' => __('R-Value is invalid or doesn\'t belong in space'),
            'celluloseins_square_footage.required' => __('Square footage is required'),
            'celluloseins_square_footage.numeric' => __('Square footage is invalid'),
            'celluloseins_square_footage.min' => __('Square footage must be a minimum of 0.01'),
        ];
    }

    public function validated()
    {
        $rvalue_score = AreaRvalueCatalog::rvalueScoreByArea($this->celluloseins_area, $this->celluloseins_rvalue_name);

        return [
            'area' => $this->celluloseins_area,
            'rvalue_name' => $this->celluloseins_rvalue_name,
            'rvalue_score' => $rvalue_score,
            'square_footage' => $this->celluloseins_square_footage,
            'bags' => BagCalculator::calculate($this->celluloseins_square_footage, $rvalue_score),
        ];
    }
}
