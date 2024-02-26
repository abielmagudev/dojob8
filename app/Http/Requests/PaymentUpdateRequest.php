<?php

namespace App\Http\Requests;

use App\Models\WorkOrder;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class PaymentUpdateRequest extends FormRequest
{
    public $work_orders_id_for_payment = '';

    public function authorize()
    {
        return auth()->user()->can('edit-work-orders');
    }

    public function rules()
    {
        return [
            'work_orders' => [
                'required',
                'array',
            ],
            'work_orders.*' => [
                sprintf('in:%s', $this->work_orders_id_for_payment),
            ],
            'payment_status' => [
                'required',
                sprintf('in:%s', WorkOrder::getPaymentStatuses()->implode(',')),
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
            'work_orders.required' => __('Choose one or more work orders'),
            'work_orders.array' => __('Choose some work orders from the list'),
            'work_orders.*.in' => __('Choose only valid work orders'),
            'payment_status.required' => __('Choose a payment status'),
            'payment_status.in' => __('Choose a valid payment status'),
            'url_back.required' => __('Parameters are missing to update the payment status'),
            'url_back.string' => __('Parameters are missing to update the payment status'),
        ];
    }

    public function prepareForValidation()
    {
        if( is_array($this->get('work_orders')) &&! empty($this->get('work_orders')) )
        {
            $this->work_orders_id_for_payment = WorkOrder::whereIn('id', $this->get('work_orders'))
                                                         ->forPayment()
                                                         ->get()
                                                         ->pluck('id')
                                                         ->implode(',');
        }
    }

    protected function failedValidation(Validator $validator)
    {
        $this->session()->flash('warning', $validator->errors()->first());

        // Llama al método parent para manejar la redirección
        parent::failedValidation($validator);
    }
}
