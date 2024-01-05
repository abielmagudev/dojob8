<?php

namespace App\Http\Requests;

use App\Models\Crew;
use App\Models\Inspection;
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
            'crew' => [
                'bail',
                'nullable',
                'integer',
                sprintf('in:%s', Crew::forInspectionTasks()->get()->pluck('id')->implode(',')),
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
            'status' => [
                'required',
            ],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'status' => Inspection::validateIsPendingStatus( $this->only(['scheduled_date', 'crew']) ) ? 'pending' : 'on hold',
        ]);
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'crew_id' => $this->crew,
            'inspector_id' => $this->inspector,
            'work_order_id' => $this->work_order,
        ]);
    }
}
