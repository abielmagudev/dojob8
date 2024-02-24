<?php

namespace App\Xapis\Stock\BattInsulationMaterial\Requests;

use App\Xapis\Stock\BattInsulationMaterial\Kernel\Rvalue;
use App\Xapis\Stock\BattInsulationMaterial\Kernel\Size;
use App\Xapis\Stock\BattInsulationMaterial\Kernel\Type;
use Illuminate\Foundation\Http\FormRequest;

use function PHPSTORM_META\map;

class BattInsulationMaterialSaveRequest extends FormRequest
{
    public $rvalue_names_by_space = '';

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'battinsmat_space' => [
                'required',
                sprintf('in:%s', Rvalue::spaces()->implode(',')),
            ],
            'battinsmat_rvalue_name' => [
                'required',
                sprintf('in:%s', $this->rvalue_names_by_space),
            ],
            'battinsmat_size' => [
                'required',
                sprintf('in:%s', Size::all()->implode(',')),
            ],
            'battinsmat_type' => [
                'required',
                sprintf('in:%s', Type::all()->implode(',')),
            ],
            'battinsmat_square_footage' => [
                'required',
                'numeric',
                'min:0.01',
            ],
            'battinsmat_square_footage_netting' => [
                'nullable',
                'numeric',
                'min:0.01',
            ],
        ];
    }

    public function messages()
    {
        return [
            'battinsmat_space.required' => __('Space is required'),
            'battinsmat_space.in' => __('Space is invalid'),
            'battinsmat_rvalue_name.required' => __('R-Value is required'),
            'battinsmat_rvalue_name.in' => __('R-Value is invalid or doesn\'t belong in space'),
            'battinsmat_size.required' => __('Size is required'),
            'battinsmat_size.in' => __('Size is invalid'),
            'battinsmat_type.required' => __('Type is required'),
            'battinsmat_type.in' => __('Type is invalid'),
            'battinsmat_square_footage.required' => __('Square footage is required'),
            'battinsmat_square_footage.numeric' => __('Square footage is invalid'),
            'battinsmat_square_footage.min' => __('Square footage must be a minimum of 0.01'),
            'battinsmat_square_footage_netting.numeric' => __('Square footage of Netting is invalid'),
            'battinsmat_square_footage_netting.min' => __('Square footage of Netting must be a minimum of 0.01'),
        ];
    }

    public function prepareForValidation()
    {
        if( Rvalue::spaceExists( $this->get('battinsmat_space') ) ) {
            $this->rvalue_names_by_space = Rvalue::allBySpace( $this->get('battinsmat_space') )->implode(',');
        }
    }

    public function validated()
    {
        return [
            'space' => $this->battinsmat_space,
            'rvalue_name' => $this->battinsmat_rvalue_name,
            'size' => $this->battinsmat_size,
            'type' => $this->battinsmat_type,
            'square_footage' => $this->battinsmat_square_footage,
            'square_footage_netting' => $this->battinsmat_square_footage_netting,
        ];
    }
}
