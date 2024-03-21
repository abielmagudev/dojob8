<?php

namespace App\Http\Requests;

use App\Models\Assessment;
use App\Models\Contractor;
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
            'status' => [
                'required',
                sprintf('in:%s', Assessment::statuses()->implode(','))
            ],
            'scheduled_date' => [
                'required',
                'date',
            ],
            'contractor' => [
                'bail',
                'required',
                'integer',
                sprintf('exists:%s,id', Contractor::class),
            ],
            'notes' => [
                'nullable',
                'string',
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
            'is_walk_thru' => $this->type,
            'contractor_id' => $this->contractor,
        ]);
    }
}
