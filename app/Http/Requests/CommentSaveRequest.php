<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CommentSaveRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'comment' => [
                'required',
                'string',
            ],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        session()->flash('danger', $validator->errors()->first());
    }
}
