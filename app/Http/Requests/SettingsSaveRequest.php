<?php

namespace App\Http\Requests;

use App\Suppliers\CountryManager;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class SettingsSaveRequest extends FormRequest
{
    public $country_codes;

    public $country_state_codes;

    public function authorize()
    {
        return auth()->user()->hasRole('SuperAdmin');
    }

    public function rules()
    {
        return [
            'company_name' => [
                'nullable',
                'string',
            ],
            'city_name' => [
                'nullable',
                'string',
            ],
            'state_code' => [
                'required',
                'string',
                sprintf('in:%s', $this->country_state_codes),
            ],
            'country_code' => [
                'required',
                'string',
                sprintf('in:%s', $this->country_codes),
            ],
        ];
    }

    public function prepareForValidation()
    {
        // $this->country_codes = CountryManager::codes()->implode(',');

        $this->country_codes = CountryManager::default()->get('code');

        $this->country_state_codes = CountryManager::exists( $this->get('country_code') ) 
                                   ? CountryManager::get( $this->get('country_code') )->get('states')->keys()->implode(',')
                                   : CountryManager::default()->get('states')->keys()->implode(',');
    }

    public function validated()
    {
        $validated = array_merge(parent::validated(), [
            'city_name' => Str::title( $this->get('city_name') ),
        ]);

        return ['data_json' => json_encode($validated)];
    }
}
