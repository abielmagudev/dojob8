<?php

namespace App\Http\Requests;

use App\Http\Controllers\UserController\Requests\ProfileQueryStringMapper;
use App\Models\User\Kernel\ProfileContainer;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('create-users');
    }

    public function prepareForValidation()
    {        
        if(! $mapper = ProfileQueryStringMapper::make($this) ) {
            return;
        }

        $this->merge([
            'profile_id' => $mapper->profileId(),
            'profile_short' => $mapper->profileShort(),
            'profile_type' => $mapper->profileType(),
        ]); 
    }

    public function rules()
    {
        return [
            'profile_short' => [
                'required',
                sprintf('in:%s', ProfileContainer::shorts()->implode(','))
            ],
            'profile_type' => [
                'bail',
                'required',
                sprintf('in:%s', ProfileContainer::types()->implode(','))
            ],
            'profile_id' => [
                'bail',
                'sometimes',
                'required',
                'integer',
                sprintf('exists:%s,id', $this->profile_type),
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return abort(404);
    }
}
