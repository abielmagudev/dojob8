<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class WorkOrderUpdateOperatorsRequest extends FormRequest
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
            ],
            'keep_old_operators' => [
                'nullable',
                'boolean',
            ],
        ];
    }

    public function withValidator($validator)
    {
        if( $validator->fails() ) {
            session()->flash('danger', $validator->errors()->first());
        }
    }
}
