<?php

namespace App\Http\Requests;

use App\Models\Assessment;
use App\Models\Client;
use App\Models\Contractor;
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
            'status' => Assessment::STATUS_INITIAL,
            'is_walk_thru' => $this->type,
            'client_id' => $this->client,
            'contractor_id' => $this->contractor,
        ]);
    }
}
