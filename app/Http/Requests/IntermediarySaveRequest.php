<?php

namespace App\Http\Requests;

use App\Helpers\CountryManager;
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
                'required',
                'string',
                sprintf('unique:%s,name,%s', Intermediary::class, $this->intermediary_id),
            ],
            'alias' => [
                'required',
                'string',
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
                'nullable',
                'string',
            ],
            'zip_code' => [
                'nullable',
                'string',
            ],
            'country_code' => [
                'required',
                sprintf('in:%s', $this->country_codes),
            ],
            'state_code' => [
                'required',
                sprintf('in:%s', $this->state_codes),
            ],
            'city' => [
                'required',
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
            'phone_number.required' => __('Phone number is required'),
            'phone_number.string' => __('Enter a valid phone number'),
            'mobile_number.string' => __('Enter a valid mobile number'),
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
}
