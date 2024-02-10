<?php

namespace App\Http\Requests;

use App\Suppliers\CountryManager;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ClientSaveRequest extends FormRequest
{
    public $country_codes;

    public $country_state_codes;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'last_name' => [
                'required',
                'string',
            ],
            'phone_number' => [
                'required',
            ],
            'mobile_number' => [
                'nullable',
            ],
            'email' => [
                'nullable',
                'email',
            ],
            'street' => [
                'required',
                'string',
            ],
            'city_name' => [
                'required',
                'string',
            ],
            'state_code' => [
                'required',
                sprintf('in:%s', $this->country_state_codes),
            ],
            'country_code' => [
                'required',
                sprintf('in:%s', $this->country_codes),
            ],
            'zip_code' => [
                'required',
                'min:5',
            ],
            'district_code' => [
                'nullable',
                'string',
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
            'country_code.in' => __('The selected country is invalid'),
            'district_code.string' => __('Enter a valid council district'),
            'state_code.in' => __('The selected state is invalid'),
        ];
    }

    public function prepareForValidation()
    {
        $this->country_codes = CountryManager::default()->get('code');

        $this->country_state_codes = CountryManager::exists( $this->get('country_code') ) 
                                   ? CountryManager::get( $this->get('country_code') )->get('states')->keys()->implode(',')
                                   : CountryManager::default()->get('states')->keys()->implode(',');
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'full_name' => Str::title( sprintf('%s %s', $this->name, $this->last_name) ),
            'updated_by' => mt_rand(1, 10),
        ]);
    }
}
