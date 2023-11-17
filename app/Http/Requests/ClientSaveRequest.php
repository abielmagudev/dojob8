<?php

namespace App\Http\Requests;

use App\Helpers\CountryManager;
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
            'lastname' => [
                'required',
                'string',
            ],
            'street' => [
                'required',
                'string',
            ],
            'zip_code' => [
                'required',
                'min:5',
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
            'phone_number' => [
                'nullable',
            ],
            'mobile_number' => [
                'nullable',
            ],
            'email' => [
                'nullable',
                'email',
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
        return array_merge(parent::validated(), [
            'name' => Str::title($this->name),
            'lastname' => Str::title($this->lastname),
            'fullname' => sprintf('%s %s', Str::title($this->name), Str::title($this->lastname)),
            'street' => Str::title($this->street),
            'city' => Str::title($this->city),
        ]);
    }
}
