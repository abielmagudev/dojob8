<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'bail',
                'required',
                'string',
                'min:6',
                sprintf('regex:%s', User::NAME_PATTERN),
                sprintf('unique:%s,name,%s', User::class, $this->route('user')->id),
            ],
            'email' => [
                'bail',
                'required',
                'email',
                sprintf('unique:%s,email,%s', User::class, $this->route('user')->id),
            ],
            'password' => [
                'nullable',
                'min:8',
            ],
            'confirm_password' => [
                'required_with:password',
                'same:password',
            ],
            'is_active' => [
                'boolean',
            ],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'is_active' => (int) $this->has('is_active'),
        ]);
    }

    public function validated()
    {
        if( is_null($this->password) ) {
            return collect( parent::validated() )->except('password')->toArray();
        }

        return parent::validated();
    }
}
