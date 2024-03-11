<?php

namespace App\Http\Requests;

use App\Models\Agency;
use App\Models\Crew;
use App\Models\Inspection\Kernel\InspectionStatusCatalog;
use Illuminate\Foundation\Http\FormRequest;

class InspectionUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('edit-inspections');
    }

    public function rules()
    {
        return [
            'scheduled_date' => [
                'nullable',
                'date',
            ],
            'agency' => [
                'bail',
                'required',
                'integer',
                sprintf('exists:%s,id,is_active,1', Agency::class),
            ],
            'inspector_name' => [
                'nullable',
                'string',
            ],
            'observations' => [
                'nullable',
                'string',
            ],
            'crew' => [
                'bail',
                'nullable',
                'integer',
                sprintf('in:%s', Crew::purposeInspections()->active()->get()->pluck('id')->implode(',')),
            ],
            'replace_crew_members' => [
                'sometimes',
                'boolean',
            ],
            'status' => [
                'required',
                sprintf('in:%s', InspectionStatusCatalog::all()->implode(',')),
            ],
        ];
    }

    public function messages()
    {
        return [
            'replace_crew_members.boolean' => __("Choose a valid option for replace crew members."),
        ];
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'agency_id' => $this->get('agency'),
            'crew_id' => $this->get('crew'),
            'status' => $this->get('status'),
        ]);
    }
}
