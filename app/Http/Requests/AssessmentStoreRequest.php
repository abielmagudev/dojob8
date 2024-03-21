<?php

namespace App\Http\Requests;

use App\Models\Assessment;
use App\Models\Client;
use App\Models\Contractor;
use App\Models\Crew;
use Illuminate\Foundation\Http\FormRequest;

class AssessmentStoreRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('create-assessments');
    }

    public function rules()
    {
        return [
            'client' => [
                'bail',
                'required',
                'integer',
                sprintf('exists:%s,id', Client::class),
            ],
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
            'client_id' => $this->client,
            'contractor_id' => $this->contractor,
            'crew_id' => $this->crew,
            'is_walk_thru' => $this->type,
            'status' => Assessment::STATUS_INITIAL,
        ]);
    }
}
