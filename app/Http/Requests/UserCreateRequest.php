<?php

namespace App\Http\Requests;

use App\Models\User\Kernel\ProfileMapper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    protected $mapper;

    public function authorize()
    {
        return auth()->user()->can('create-users');
    }

    public function prepareForValidation()
    {        
        if(! $handler = $this->makeProfileQueryStringHandler()) {
            return;
        }

        if(! ProfileMapper::shortExists($handler->profile_short) ) {
            return;
        }

        $this->merge([
            'profile_id' => $handler->profile_id,
            'profile_short' => $handler->profile_short,
            'profile_type' => ProfileMapper::getType($handler->profile_short),
        ]); 
    }

    protected function makeProfileQueryStringHandler()
    {
        if( count($this->all()) == 0 ) {
            return;
        }

        $all = $this->all();
        $keys = array_keys($all);
        $short = reset($keys);

        return (object) [
            'profile_id' => $all[$short],
            'profile_short' => $short,
        ];
    }

    public function rules()
    {
        return [
            'profile_short' => [
                'required',
                sprintf('in:%s', ProfileMapper::shorts()->implode(','))
            ],
            'profile_type' => [
                'bail',
                'required',
                sprintf('in:%s', ProfileMapper::types()->implode(','))
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
