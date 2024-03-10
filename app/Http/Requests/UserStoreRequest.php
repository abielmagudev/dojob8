<?php

namespace App\Http\Requests;

use App\Http\Controllers\UserController\Requests\ProfileJsonInputMapper;
use App\Models\Member;
use App\Models\User;
use App\Models\User\Kernel\ProfileContainer;
use App\Models\User\Services\RoleCatalogManager;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('create-users');
    }

    public function prepareForValidation()
    {
        if(! $mapper = ProfileJsonInputMapper::make($this) ) {
            return;
        }

        $this->merge([
            'profile_type' => $mapper->profileType(),
            'profile_id' => $mapper->profileId(),
            'profile_short' => $mapper->profileShort(),
        ]);
    }

    public function rules()
    {
        return [
            'role' => [
                'required',
                sprintf('in:%s', RoleCatalogManager::byProfile( app($this->profile_type) )->implode(',')),
            ],
            'profile' => [
                'required',
                'json',
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
                function ($attribute, $value, $fail) {
                    if( $this->profile_type == Member::class && $value == auth()->id() ) {
                        $fail('Invalid user profile');
                    }
                },
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
                // sprintf('regex:%s', User::PASSWORD_PATTERN),
            ],
        ];
    }

    public function messages()
    {
        return [
            'profile.*' => __('Select a user profile previously'),
            'profile_type.*' => __('Invalid user profile'),
            'profile_id.*' => __('Invalid user profile'),
        ];
    }
}
