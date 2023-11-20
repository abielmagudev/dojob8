<?php

namespace App\Http\Requests;

use App\Models\Inspector;
use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class InspectionSaveRequest extends FormRequest
{
    public $order_rules = [];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'status' => [
                'nullable',
                'numeric',
                'in:0,1',
            ],
            'schedule' => [
                'required',
                'date',
            ],
            'inspector' => [
                'bail',
                'required',
                'integer',
                sprintf('exists:%s,id', Inspector::class),
            ],
            'observations' => [
                'nullable',
                'string',
            ],
            'notes' => [
                'nullable',
                'string',
            ],
            'order' => $this->order_rules,
        ];
    }

    public function prepareForValidation()
    {
        if( $this->isMethod('POST') )
        {
            $this->order_rules = [
                'bail', 
                'required', 
                'integer', 
                sprintf('exists:%s,id', Order::class),
            ];
        }
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'is_approved' => $this->status,
            'scheduled_date' => $this->schedule,
            'inspector_id' => $this->inspector,
            'order_id' =>  $this->isMethod('POST') ? $this->order : $this->route('inspection')->order_id,
        ]);
    }
}
