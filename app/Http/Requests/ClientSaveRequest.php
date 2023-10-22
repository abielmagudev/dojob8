<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ClientSaveRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
            ],
            'lastname' => [
                'required',
            ],
            'address' => [
                'required',
            ],
            'zip_code' => [
                'required',
                'min:5',
            ],
            'city' => [
                'required',
            ],
            'state' => [
                'required',
            ],
            'country' => [
                'required',
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
            ],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'name' => Str::title($this->name),
            'lastname' => Str::title($this->lastname),
            'address' => Str::title($this->address),
            'city' => Str::title($this->city),
            'state' => Str::title($this->state),
            'country' => Str::title($this->country),
        ]);
    }
}
