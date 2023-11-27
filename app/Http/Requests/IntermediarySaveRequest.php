<?php

namespace App\Http\Requests;

use App\Suppliers\CountryManager;
use App\Models\Intermediary;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class IntermediarySaveRequest extends FormRequest
{
    public $intermediary_id;

    public $country_codes;

    public $state_codes;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'bail',
                'required',
                'string',
                sprintf('unique:%s,name,%s', Intermediary::class, $this->intermediary_id),
            ],
            'alias' => [
                'bail',
                'required',
                'string',
                'max:10',
                sprintf('unique:%s,alias,%s', Intermediary::class, $this->intermediary_id),
            ],
            'contact' => [
                'required',
                'string',
            ],
            'phone_number' => [
                'required',
                'string',
            ],
            'mobile_number' => [
                'nullable',
                'string',
            ],
            'email' => [
                'nullable',
                'email',
            ],
            'street' => [
                'required',
                'string',
            ],
            'city' => [
                'required',
                'string',
            ],
            'state_code' => [
                'required',
                sprintf('in:%s', $this->state_codes),
            ],
            'country_code' => [
                'required',
                sprintf('in:%s', $this->country_codes),
            ],
            'zip_code' => [
                'required',
                'string',
                'min:5',
            ],
            'notes' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function messages()
    {
        return [
            'country_code.required' => __('Choose the country'),
            'country_code.in' => __('Choose a valid country'),
            'state_code.required' => __('Choose the state'),
            'state_code.in' => __('Choose a valid state'),
        ];
    }

    public function prepareForValidation()
    {
        $this->intermediary_id = $this->route('intermediary')->id ?? 0;

        $this->country_codes = CountryManager::codes()->implode(',');

        $this->state_codes = CountryManager::exists( $this->get('country_code', '?') ) 
                           ? CountryManager::get( $this->country_code )->get('states')->keys()->implode(',') 
                           : '?';
    }

    public function validated()
    {
        if( $this->isMethod('POST') ) {
            return parent::validated();
        }

        return array_merge(parent::validated(), [
            'is_available' => $this->has('available') ? 1 : 0,
        ]);
    }
}
