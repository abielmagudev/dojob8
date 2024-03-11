<?php

namespace App\Xapis\Stock\BlownInsulation\Requests;

use App\Xapis\Stock\BlownInsulation\Kernel\BagCalculator;
use App\Xapis\Stock\BlownInsulation\Kernel\RvalueManager;
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
            'blownins_space' => [
                'required',
                sprintf('in:%s', RvalueManager::spaces()->implode(',')),
            ],
            'blownins_rvalue_name' => [
                'required',
                sprintf('in:%s', RvalueManager::rvalueNamesBySpace($this->blownins_space)->implode(',')),
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
            'blownins_space.required' => __('Space is required'),
            'blownins_space.in' => __('Space is invalid'),
            'blownins_rvalue_name.required' => __('R-Value is required'),
            'blownins_rvalue_name.in' => __('R-Value is invalid or doesn\'t belong in space'),
            'blownins_square_footage.required' => __('Square footage is required'),
            'blownins_square_footage.numeric' => __('Square footage is invalid'),
            'blownins_square_footage.min' => __('Square footage must be a minimum of 0.01'),
        ];
    }

    public function validated()
    {
        return [
            'space' => $this->blownins_space,
            'rvalue_name' => $this->blownins_rvalue_name,
            'rvalue_score' => RvalueManager::rvalueScoreBySpace($this->blownins_space, $this->blownins_rvalue_name),
            'square_footage' => $this->blownins_square_footage,
            'bags' => BagCalculator::get($this->blownins_space, $this->blownins_rvalue_name, $this->blownins_square_footage),
        ];
    }
}
