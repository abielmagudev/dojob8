<?php

namespace App\Http\Requests;

use App\Models\Contractor;
use App\Suppliers\CountryManager;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ContractorSaveRequest extends FormRequest
{
    public $contractor_id;

    public $country_codes;

    public $country_state_codes;

    public function authorize()
    {
        return auth()->user()->canAny(['create-contractors', 'edit-contractors']);
    }

    public function rules()
    {
        return [
            'name' => [
                'bail',
                'required',
                'string',
                sprintf('unique:%s,name,%s', Contractor::class, $this->contractor_id),
            ],
            'alias' => [
                'bail',
                'required',
                'string',
                'max:10',
                sprintf('unique:%s,alias,%s', Contractor::class, $this->contractor_id),
            ],
            'contact_name' => [
                'required',
                'string',
            ],
            'email' => [
                'nullable',
                'email',
            ],
            'mobile_number' => [
                'nullable',
                'string',
            ],
            'phone_number' => [
                'nullable',
                'string',
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
            'contact_name.required' => __("Contact's name is required"),
            'contact_name.string' => __("Contact's name must be written in a correct format"),
            'country_code.required' => __('Choose the country'),
            'country_code.in' => __('Choose a valid country'),
            'state_code.required' => __('Choose the state'),
            'state_code.in' => __('Choose a valid state'),
        ];
    }

    public function prepareForValidation()
    {
        if( $this->filled('name') &&! $this->filled('alias') )
        {
            $this->merge([
                'alias' => initials( $this->get('name') )
            ]);
        }

        $this->contractor_id = $this->route('contractor')->id ?? 0;

        $this->country_codes = CountryManager::default()->get('code');

        $this->country_state_codes = CountryManager::exists( $this->get('country_code') ) 
                                   ? CountryManager::get( $this->get('country_code') )->get('states')->keys()->implode(',')
                                   : CountryManager::default()->get('states')->keys()->implode(',');
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'is_active' => $this->get('active'),
        ]);
    }
}
