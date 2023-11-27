<?php

namespace App\Http\Requests;

use App\Models\Inspector;
use App\Models\WorkOrder;
use Illuminate\Foundation\Http\FormRequest;

class InspectionSaveRequest extends FormRequest
{
    public $work_order_rules = [];

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
            'work_order' => $this->work_order_rules,
        ];
    }

    public function prepareForValidation()
    {
        if( $this->isMethod('POST') )
        {
            $this->work_order_rules = [
                'bail', 
                'required', 
                'integer', 
                sprintf('exists:%s,id', WorkOrder::class),
            ];
        }
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'is_approved' => $this->status,
            'scheduled_date' => $this->schedule,
            'inspector_id' => $this->inspector,
            'work_order_id' =>  $this->isMethod('POST') ? $this->work_order : $this->route('inspection')->work_order_id,
        ]);
    }
}
