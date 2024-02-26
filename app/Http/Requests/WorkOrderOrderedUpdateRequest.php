<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WorkOrderOrderedUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('edit-work-orders');
    }

    public function rules()
    {
        return [
            'ordered' => [
                'required',
                'array',
            ],
            'url_back' => [
                'required',
                'string',
            ],
        ];
    }

    public function withValidator($validator)
    {
        if( $validator->fails() ) {
            $this->session()->flash('danger', 'An error occurred while updating the order of work orders, try again...');
        }
    }
}
