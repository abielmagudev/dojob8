<?php

namespace App\Http\Requests;

use App\Models\Inspection;
use Illuminate\Foundation\Http\FormRequest;

class InspectionStatusUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('edit-inspections');
    }

    public function rules()
    {
        return [
            'inspections' => [
                'required',
                'array',
            ],
            'status' => [
                'required',
                sprintf('in:%s', Inspection::allStatusesForm()->implode(',')),
            ],
            'url_back' => [
                'required',
                'string',
            ],
        ];
    }

    public function messages()
    {
        return [
            'inspections.required' => __('Select one or more inspections to update the status'),
            'inspections.array' => __('Select one or more from the list of inspections to update the status'),
            'status.required' => __('Select a status for updating inspections'),
            'status.in' => __('Select a valid status for updating inspections'),
            'url_back.required' => __('Parameters are missing to update the status of inspections'),
            'url_back.string' => __('Valid parameters are missing to update the status of inspections'),
        ];
    }

    public function withValidator($validator)
    {
        if( $validator->fails() ) {
            $this->session()->flash('warning', $validator->errors()->first());
        }
    }
}
