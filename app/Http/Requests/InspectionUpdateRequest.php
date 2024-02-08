<?php

namespace App\Http\Requests;

use App\Models\Agency;
use App\Models\Crew;
use App\Models\Inspection;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class InspectionUpdateRequest extends FormRequest
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
            'inspector_name' => [
                'nullable',
                'string',
            ],
            'observations' => [
                'nullable',
                'string',
            ],
            'status' => [
                'required',
                sprintf('in:%s', Inspection::allStatuses()->implode(',')),
            ],
            'agency' => [
                'bail',
                'required',
                'integer',
                sprintf('exists:%s,id', Agency::class),
            ],
            'crew' => [
                'bail',
                'nullable',
                'integer',
                sprintf('in:%s', Crew::taskInspections()->get()->pluck('id')->implode(',')),
            ],
        ];
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'inspector_name' => Str::title($this->inspector_name),
            'crew_id' => $this->crew,
            'agency_id' => $this->agency,
            'status' => Inspection::qualifyPendingStatus( $this->all() ) ? 'pending' : ($this->get('status') == 'pending' ? 'awaiting' : $this->get('status')),
        ]);
    }
}
