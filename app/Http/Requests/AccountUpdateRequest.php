<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class AccountUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                sprintf('unique:%s,email,%s', User::class, auth()->id()),
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
