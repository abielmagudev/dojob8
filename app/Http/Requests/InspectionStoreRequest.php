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
                'nullable',
                'date',
            ],
            'work_order' => [
                'bail', 
                'required', 
                'integer', 
                sprintf('exists:%s,id', WorkOrder::class),
            ],
            'inspector' => [
                'bail',
                'required',
                'integer',
                sprintf('exists:%s,id', Inspector::class),
            ],
            'crew' => [
                'bail',
                'nullable',
                'integer',
                sprintf('in:%s', Crew::forInspections()->get()->pluck('id')->implode(',')),
            ],
            'status' => [
                'required',
                sprintf('in:%s', Inspection::getAllStatus()->implode(',')),
            ],
        ];
    }

    public function prepareForValidation()
    {
        if( Inspection::validateIsPendingStatus( $this->only(['scheduled_date', 'crew']) ) ) {
            $this->merge([
                'status' => 'pending',
            ]);
        }
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'work_order_id' => $this->work_order,
            'inspector_id' => $this->inspector,
            'crew_id' => $this->crew,
        ]);
    }
}
