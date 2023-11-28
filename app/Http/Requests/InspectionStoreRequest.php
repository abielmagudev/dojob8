<?php

namespace App\Http\Requests;

use App\Models\Inspector;
use App\Models\WorkOrder;
use Illuminate\Foundation\Http\FormRequest;

class InspectionStoreRequest extends FormRequest
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
            'inspector' => [
                'bail',
                'required',
                'integer',
                sprintf('exists:%s,id', Inspector::class),
            ],
            'work_order' => [
                'bail', 
                'required', 
                'integer', 
                sprintf('exists:%s,id', WorkOrder::class),
            ],
        ];
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'inspector_id' => $this->inspector,
            'work_order_id' => $this->work_order,
        ]);
    }
}
