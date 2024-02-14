<?php

namespace App\Http\Requests;

use App\Models\WorkOrder;
use Illuminate\Foundation\Http\FormRequest;

class WorkOrderStatusUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'work_orders' => [
                'required',
                'array',
            ],
            'status' => [
                'required',
                sprintf('in:%s', WorkOrder::getAllStatuses()->implode(',')),
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
            'work_orders.required' => __('Select one or more work orders to update the status'),
            'work_orders.array' => __('Select one or more from the list of work orders to update the status'),
            'status.required' => __('Select a status for updating work orders'),
            'status.in' => __('Select a valid status for updating work orders'),
            'url_back.required' => __('Parameters are missing to update the status of work orders'),
            'url_back.string' => __('Valid parameters are missing to update the status of work orders'),
        ];
    }

    public function withValidator($validator)
    {
        if( $validator->fails() ) {
            $this->session()->flash('warning', $validator->errors()->first());
        }
    }
}
