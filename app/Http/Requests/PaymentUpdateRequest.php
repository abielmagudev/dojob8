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
        return true;
    }

    public function rules()
    {
        return [
            'payment' => [
                'required',
                sprintf('in:%s', WorkOrder::getPaymentStatuses()->implode(',')),
            ],
            'work_orders' => [
                'required',
                'array',
            ],
            'work_orders.*' => [
                sprintf('in:%s', $this->work_orders_id_for_payment),
            ],
        ];
    }

    public function messages()
    {
        return [
            'work_orders.required' => __('Choose one or more work orders.'),
            'work_orders.array' => __('Choose some work orders from the list.'),
            'work_orders.*.in' => __('Choose only valid work orders.'),
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
