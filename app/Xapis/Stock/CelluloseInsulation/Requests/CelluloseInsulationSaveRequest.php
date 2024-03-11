<?php

namespace App\Xapis\Stock\CelluloseInsulation\Requests;

use App\Xapis\Stock\CelluloseInsulation\Kernel\BagCalculator;
use App\Xapis\Stock\CelluloseInsulation\Kernel\RvalueManager;
use Illuminate\Foundation\Http\FormRequest;

class CelluloseInsulationSaveRequest extends FormRequest
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
            'celluloseins_space' => [
                'required',
                sprintf('in:%s', RvalueManager::spaces()->implode(',')),
            ],
            'celluloseins_rvalue_name' => [
                'required',
                sprintf('in:%s', RvalueManager::rvalueNamesBySpace($this->celluloseins_space)->implode(',')),
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
            'celluloseins_space.required' => __('Space is required'),
            'celluloseins_space.in' => __('Space is invalid'),
            'celluloseins_rvalue_name.required' => __('R-Value is required'),
            'celluloseins_rvalue_name.in' => __('R-Value is invalid or doesn\'t belong in space'),
            'celluloseins_square_footage.required' => __('Square footage is required'),
            'celluloseins_square_footage.numeric' => __('Square footage is invalid'),
            'celluloseins_square_footage.min' => __('Square footage must be a minimum of 0.01'),
        ];
    }

    public function validated()
    {
        return [
            'space' => $this->celluloseins_space,
            'rvalue_name' => $this->celluloseins_rvalue_name,
            'rvalue_score' => RvalueManager::rvalueScoreBySpace($this->celluloseins_space, $this->celluloseins_rvalue_name),
            'square_footage' => $this->celluloseins_square_footage,
            'bags' => BagCalculator::get($this->celluloseins_space, $this->celluloseins_rvalue_name, $this->celluloseins_square_footage),
        ];
    }
}
