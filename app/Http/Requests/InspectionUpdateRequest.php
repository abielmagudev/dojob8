<?php

namespace App\Http\Requests;

use App\Models\Crew;
use App\Models\Inspection;
use App\Models\Inspector;
use Illuminate\Foundation\Http\FormRequest;

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
            'crew' => [
                'bail',
                'nullable',
                'integer',
                sprintf('in:%s', Crew::forInspections()->get()->pluck('id')->implode(',')),
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
            'status' => [
                sprintf('in:%s', Inspection::getAllStatuses()->implode(',')),
            ],
        ];
    }

    public function prepareForValidation()
    {
        if(! Inspection::validateIsPendingStatus( $this->only(['scheduled_date', 'crew']) ) )
        {
            $this->merge([
                'status' => $this->get('status') <> 'pending' ? $this->get('status') : 'on hold',
            ]);
        }
        else
        {
            $this->merge([
                'status' => 'pending',
            ]);
        }
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'crew_id' => $this->crew,
            'inspector_id' => $this->inspector,
        ]);
    }
}
