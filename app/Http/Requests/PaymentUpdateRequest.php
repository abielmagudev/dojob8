<?php

namespace App\Http\Requests;

use App\Models\Payment;
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
            'payments' => [
                'required',
                'array',
            ],
            'payments.*' => [
                sprintf('exists:%s,id', Payment::class)
            ],
            'status' => [
                'required',
                sprintf('in:%s', Payment::collectionAllStatuses()->implode(',')),
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
            'payments.required' => __('Choose one or more payments'),
            'payments.array' => __('Choose some payments from the list'),
            'payments.*.exists' => __('Choose only valid payments'),
            'status.required' => __('Choose a payment status'),
            'status.in' => __('Choose a valid payment status'),
            'url_back.required' => __('Parameters are missing to update the payment status'),
            'url_back.string' => __('Parameters are missing to update the payment status'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->session()->flash('warning', $validator->errors()->first());

        // Llama al método parent para manejar la redirección
        parent::failedValidation($validator);
    }
}
