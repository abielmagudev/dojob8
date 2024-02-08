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

    public function validated()
    {
        return array_merge(parent::validated(), [
            'agency_id' => $this->agency,
            'crew_id' => $this->crew,
            'inspector_name' => Str::title($this->inspector_name),
            'status' => Inspection::qualifyPendingStatus( $this->all() ) ? 'pending' : $this->get('status'),
            'work_order_id' => $this->work_order,
        ]);
    }
}
