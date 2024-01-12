<?php

namespace App\Http\Requests;

use App\Suppliers\CountryManager;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ClientSaveRequest extends FormRequest
{
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
                sprintf('in:%s', $this->state_codes),
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
            'state_code.in' => __('The selected state is invalid'),
        ];
    }

    public function prepareForValidation()
    {
        $this->country_codes = CountryManager::only('US')->keys()->implode(',');

        $this->state_codes = CountryManager::exists( $this->get('country_code', '?') ) 
                           ? CountryManager::get( $this->country_code )->get('states')->keys()->implode(',') 
                           : '?';
    }

    public function validated()
    {
        $data = [
            'full_name' => Str::title( sprintf('%s %s', $this->name, $this->last_name) ),
            'updated_by' => mt_rand(1, 10),
        ];

        if( $this->isMethod('POST') ) {
            $data['created_by'] = mt_rand(1, 10);
        }

        return array_merge(parent::validated(), $data);
    }
}
