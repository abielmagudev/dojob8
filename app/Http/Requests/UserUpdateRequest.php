<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\User\Services\RoleCatalogManager;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public $user_id;

    public $roles;

    public function authorize()
    {
        return auth()->user()->can('edit-users') && $this->route('user')->id <> auth()->id();
    }

    public function prepareForValidation()
    {
        $this->user_id = $this->route('user')->id;

        $this->roles = RoleCatalogManager::byProfile( $this->route('user')->profile )->implode(',');
    }

    public function rules()
    {
        return [
            'role' => [
                sprintf('in:%s', $this->roles),
            ],
            'name' => [
                'bail',
                'required',
                'string',
                'min:6',
                sprintf('regex:%s', User::NAME_PATTERN),
                sprintf('unique:%s,name,%s', User::class, $this->user_id),
            ],
            'email' => [
                'bail',
                'required',
                'email',
                sprintf('unique:%s,email,%s', User::class, $this->user_id),
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

    public function validated()
    {
        $validated = is_null($this->password) ? collect( parent::validated() )->except('password')->toArray() : parent::validated();

        return array_merge($validated, [
            'is_active' => $this->filled('active'),
        ]);
    }
}
