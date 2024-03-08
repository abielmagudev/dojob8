<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\User\Kernel\ProfileMapper;
use App\Models\User\UserProfiler;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public $profile;

    public function authorize()
    {
        return auth()->user()->can('create-users');
    }

    public function prepareForValidation()
    {
        if(! $handler = $this->makeProfileInputHandler() ) {
            return;
        }

        if(! ProfileMapper::shortExists($handler->profile_short) ) {
            return;
        }

        $this->merge([
            'profile_type' => ProfileMapper::getType($handler->profile_short),
            'profile_id' => $handler->profile_id,
            'profile_role' => $handler->profile_short,
        ]);
    }

    protected function makeProfileInputHandler()
    {
        if(! $this->filled('profile') ||! isJson($this->input('profile')) ) {
            return;
        }

        $profile_input = json_decode($this->input('profile'), true);
        $profile_short = key($profile_input);

        return (object) [
            'profile_id' => $profile_input[$profile_short],
            'profile_short' => $profile_short,
        ];
    }

    public function rules()
    {
        return [
            'profile' => [
                'required',
                'json',
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
                sprintf('not_in:%s', auth()->id()),
                sprintf('exists:%s,id', $this->profile_type),
            ],
            'name' => [
                'bail',
                'required',
                'string',
                'min:6',
                sprintf('regex:%s', User::NAME_PATTERN),
                sprintf('unique:%s,name', User::class),
            ],
            'email' => [
                'bail',
                'required',
                'email',
                sprintf('unique:%s,email', User::class),
            ],
            'password' => [
                'sometimes',
                'nullable',
                'confirmed',
                'string',
                'min:8',
                // 'regex:/^[A-Za-z0-9_@#%!&*^()-=]+$/',
            ],
        ];
    }
}
