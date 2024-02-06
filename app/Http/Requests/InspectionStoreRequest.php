<?php

namespace App\Http\Requests;

use App\Models\Agency;
use App\Models\Crew;
use App\Models\Inspection;
use App\Models\WorkOrder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

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
            'status' => [
                'required',
                sprintf('in:%s', Inspection::allStatuses()->implode(',')),
            ],
            'inspector_name' => [
                'nullable',
                'string',
            ],
            'crew' => [
                'bail',
                'nullable',
                'integer',
                sprintf('in:%s', Crew::taskInspections()->get()->pluck('id')->implode(',')),
            ],
            'agency' => [
                'bail',
                'required',
                'integer',
                sprintf('exists:%s,id', Agency::class),
            ],
            'work_order' => [
                'bail', 
                'required', 
                'integer', 
                sprintf('exists:%s,id', WorkOrder::class),
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
            'inspector_name' => Str::title($this->inspector_name),
            'crew_id' => $this->crew,
            'agency_id' => $this->agency,
            'work_order_id' => $this->work_order,
        ]);
    }
}
