<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSaveRequest extends FormRequest
{
    public $password_is_required;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                $this->password_is_required,
                'min:8',
            ],
            'confirm_password' => [
                'required_with:password',
                'same:password',
            ],
        ];
    }

    public function prepareForValidation()
    {
        $this->password_is_required = $this->isMethod('POST') ? 'required' : 'nullable';
    }
}
