<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CrewMemberUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'members' => [
                'nullable',
                'array'
            ],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        session()->flash('danger', $validator->errors()->first());
    }
}
