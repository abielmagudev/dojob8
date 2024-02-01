<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class WorkOrderMembersUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'scheduled_date' => [
                'required',
                'date',
                sprintf('after_or_equal:%s', now()->format('Y-m-d'))
            ],
            'keep_old_operators' => [
                'nullable',
                'boolean',
            ],
        ];
    }

    public function withValidator(Validator $validator)
    {
        if( $validator->fails() ) {
            session()->flash('danger', $validator->errors()->first());
        }
    }
}
