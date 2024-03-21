<?php

namespace App\Http\Requests;

use App\Models\Assessment;
use App\Models\Contractor;
use App\Models\Crew;
use Illuminate\Foundation\Http\FormRequest;

class AssessmentUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('edit-assessments');
    }

    public function rules()
    {
        return [
            'type' => [
                'required',
                'integer',
            ],
            'scheduled_date' => [
                'nullable',
                'date',
            ],
            'crew' => [
                'bail',
                'nullable',
                sprintf('in:%s', Crew::task('assessments')->pluck('id')->implode(',')),
            ],
            'contractor' => [
                'bail',
                'nullable',
                'integer',
                sprintf('exists:%s,id', Contractor::class),
            ],
            'notes' => [
                'nullable',
                'string',
            ],
            'status' => [
                'required',
                sprintf('in:%s', Assessment::statuses()->implode(','))
            ],
        ];
    }

    public function messages()
    {
        return [
            'type.integer' => __('Choose a valid type'),
        ];
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'contractor_id' => $this->contractor,
            'crew_id' => $this->crew,
            'is_walk_thru' => $this->type,
        ]);
    }
}
