<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('edit-users') && $this->route('user')->id <> auth()->id();
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
                'sometimes',
                'nullable',
                'confirmed',
                'string',
                'min:8',
                // 'regex:/^[A-Za-z0-9_@#%!&*^()-=]+$/',
            ],
        ];
    }

    public function validated()
    {
        $validated = is_null($this->password) ? collect( parent::validated() )->except('password')->toArray() : parent::validated();

        return array_merge($validated, [
            'is_active' => $this->get('active'),
        ]);
    }
}
